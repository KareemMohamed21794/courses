"use strict";

/**
 * Shared DataTables export buttons.
 *
 * Exports are produced server side so they always cover the full filtered
 * result set rather than just the rows currently on screen, and so PDF and
 * Excel share one branded layout. Every list page gets the same two buttons by
 * calling KTReportExport.buttons() with its own filter collector.
 */
var KTReportExport = function () {
    var pdfIcon = '<span class="svg-icon svg-icon-2 me-1">'
        + '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'
        + '<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"/>'
        + '<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>'
        + '<path d="M8.3 16.2C8.1 16.2 7.9 16.1 7.8 16C7.5 15.8 7.4 15.3 7.7 15L10.4 11.6L12.9 14.4L14.9 11.8C15.1 11.5 15.6 11.4 15.9 11.7C16.2 11.9 16.3 12.4 16 12.7L13 16.7C12.9 16.9 12.7 17 12.4 17C12.2 17 12 16.9 11.8 16.8L9.4 14.1L8.9 15.9C8.8 16.1 8.6 16.2 8.3 16.2Z" fill="currentColor"/>'
        + '</svg></span>';

    var excelIcon = '<span class="svg-icon svg-icon-2 me-1">'
        + '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'
        + '<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor"/>'
        + '<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>'
        + '<path d="M10.4 12.5L8.5 15.5C8.3 15.8 8.4 16.3 8.7 16.5C9 16.7 9.5 16.6 9.7 16.3L11.3 13.7L12.9 16.3C13.1 16.6 13.6 16.7 13.9 16.5C14.2 16.3 14.3 15.8 14.1 15.5L12.2 12.5L14.1 9.5C14.3 9.2 14.2 8.7 13.9 8.5C13.6 8.3 13.1 8.4 12.9 8.7L11.3 11.3L9.7 8.7C9.5 8.4 9 8.3 8.7 8.5C8.4 8.7 8.3 9.2 8.5 9.5L10.4 12.5Z" fill="currentColor"/>'
        + '</svg></span>';

    /** Builds the export URL from the page's current filters. */
    var buildUrl = function (baseUrl, params, format) {
        var query = [];

        Object.keys(params || {}).forEach(function (key) {
            var value = params[key];
            if (value === null || value === undefined || value === '') {
                return;
            }
            query.push(encodeURIComponent(key) + '=' + encodeURIComponent(value));
        });

        query.push('format=' + format);

        return baseUrl + (baseUrl.indexOf('?') === -1 ? '?' : '&') + query.join('&');
    };

    var download = function (baseUrl, collect, format) {
        // Both endpoints reply with Content-Disposition: attachment, so the
        // current page stays put instead of opening an empty tab.
        window.location.href = buildUrl(baseUrl, collect ? collect() : {}, format);
    };

    return {
        /**
         * @param {string} baseUrl  The report export route.
         * @param {function} collect Returns the current filter values as an object.
         */
        buttons: function (baseUrl, collect) {
            return [
                {
                    text: pdfIcon + 'تصدير PDF',
                    className: 'btn btn-light-danger',
                    titleAttr: 'تنزيل التقرير بصيغة PDF',
                    action: function () {
                        download(baseUrl, collect, 'pdf');
                    }
                },
                {
                    text: excelIcon + 'تصدير Excel',
                    className: 'btn btn-light-success',
                    titleAttr: 'تنزيل التقرير بصيغة Excel',
                    action: function () {
                        download(baseUrl, collect, 'excel');
                    }
                }
            ];
        },

        url: buildUrl
    };
}();
