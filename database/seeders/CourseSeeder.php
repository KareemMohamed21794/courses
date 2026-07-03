<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Storage::disk('local')->makeDirectory('courses');

        $placeholderPdf = storage_path('app/courses/sample.pdf');
        if (!file_exists($placeholderPdf)) {
            file_put_contents($placeholderPdf, '%PDF-1.4 sample placeholder');
        }

        Course::firstOrCreate(
            ['title' => 'كورس تجريبي'],
            [
                'description' => 'هذا كورس تجريبي لاختبار المنصة. يمكنك استبداله بكورس حقيقي من لوحة التحكم.',
                'thumbnail' => null,
                'pdf_file' => 'sample.pdf',
                'is_active' => true,
            ]
        );
    }
}
