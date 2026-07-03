<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;

trait HandlesAdminDataTable
{
    protected function searchValue(Request $request): string
    {
        $search = $request->input('search.value', $request->input('search', ''));

        if (is_array($search)) {
            $search = $search['value'] ?? '';
        }

        return trim((string) $search);
    }
}
