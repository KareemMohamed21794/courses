<?php

namespace App\Support\Reports;

use TCPDF_FONTS;

/**
 * Prepares Arabic text for engines that have no bidi/shaping support.
 *
 * dompdf draws glyphs in the order it receives them and never joins Arabic
 * letters, so Arabic comes out disconnected and back to front. This class runs
 * the text through the Unicode bidirectional algorithm and the Arabic joining
 * rules (borrowed from TCPDF, already a dependency) to produce a *visually
 * ordered* string built from Arabic Presentation Forms-B. The bundled DejaVu
 * Sans covers 141 of those 144 glyphs, so the result renders correctly.
 *
 * Anything shaped here must then be laid out left-to-right, since the reorder
 * has already happened.
 */
class ArabicShaper
{
    /** Unicode ranges that make up Arabic text, as a character-class body. */
    const ARABIC_RANGES = '\x{0600}-\x{06FF}\x{0750}-\x{077F}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}';

    /** @var array<string, string> */
    private static $cache = [];

    public static function containsArabic(string $text): bool
    {
        return (bool) preg_match('/[' . self::ARABIC_RANGES . ']/u', $text);
    }

    /**
     * Reorder and join a single run of text. Latin-only text is returned as-is.
     */
    public static function shape(string $text, bool $rtl = true): string
    {
        if ($text === '' || !self::containsArabic($text)) {
            return $text;
        }

        $key = ($rtl ? 'r:' : 'l:') . $text;
        if (isset(self::$cache[$key])) {
            return self::$cache[$key];
        }

        $codepoints = [];
        foreach (preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY) as $char) {
            $codepoints[] = mb_ord($char, 'UTF-8');
        }

        // utf8Bidi() takes $currentfont by reference and only reads 'cw' when
        // deciding whether a diacritic ligature exists; empty arrays are safe.
        $font = ['type' => 'TrueTypeUnicode', 'cw' => [], 'subsetchars' => []];
        $shaped = TCPDF_FONTS::utf8Bidi($codepoints, $text, $rtl ? 'R' : 'L', false, $font);

        $out = '';
        foreach ($shaped as $codepoint) {
            $out .= mb_chr($codepoint, 'UTF-8');
        }

        return self::$cache[$key] = $out;
    }

    /**
     * Shape the Arabic islands of a left-to-right run, leaving them where they
     * are. Amounts such as "30.00 ج.م" need this: the figure has to stay in
     * front, but the currency symbol still has to be reversed and joined like
     * any other Arabic word.
     *
     * A whole-string RTL pass cannot do this, because the bidi algorithm would
     * move the symbol ahead of the figure.
     */
    public static function shapeLtr(string $text): string
    {
        $arabic = '[' . self::ARABIC_RANGES . ']';

        // An island runs from the first Arabic letter to the last, and may hold
        // spaces or punctuation in between so multi-word text stays one run.
        $pattern = '/' . $arabic . '(?:[' . self::ARABIC_RANGES . '\s\p{P}]*' . $arabic . ')?/u';

        return preg_replace_callback($pattern, function (array $match) {
            return self::shape($match[0], true);
        }, $text);
    }

    /**
     * Shape every text node of an HTML document, leaving markup, CSS and
     * attributes untouched. Applied once to the fully rendered report so
     * templates can be written in plain logical-order Arabic.
     *
     * An element carrying the "ltr" class marks its text as a left-to-right
     * run. That matters for amounts such as "30.00 ج.م": under an RTL base
     * direction the bidi algorithm moves the currency symbol in front of the
     * figure, which reads as though the cell were flipped.
     */
    public static function shapeHtml(string $html, bool $rtl = true): string
    {
        // The capture keeps the tag that directly encloses the text node, which
        // is what decides the direction of the run.
        return preg_replace_callback('/(<[^<>]*>)([^<>]+)(?=<)/u', function (array $match) use ($rtl) {
            $tag = $match[1];
            $text = $match[2];

            if (!self::containsArabic($text)) {
                return $match[0];
            }

            // Keep the template's indentation out of the bidi run, otherwise the
            // surrounding whitespace gets reordered along with the text.
            preg_match('/^(\s*)(.*?)(\s*)$/us', $text, $parts);

            $decoded = html_entity_decode($parts[2], ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $shaped = $rtl && !self::marksLtrRun($tag)
                ? self::shape($decoded, true)
                : self::shapeLtr($decoded);

            $shaped = htmlspecialchars($shaped, ENT_QUOTES | ENT_HTML5, 'UTF-8', false);

            return $tag . $parts[1] . $shaped . $parts[3];
        }, $html);
    }

    private static function marksLtrRun(string $tag): bool
    {
        return (bool) preg_match('/\bclass\s*=\s*(["\'])[^"\']*\bltr\b/i', $tag);
    }
}
