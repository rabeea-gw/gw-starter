<?php

use App\Helpers\StatusCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

if (!function_exists('user')) {
    function user()
    {
        return Auth::user();
    }
}

if (!function_exists('per_page')) {
    function per_page()
    {
        $pre_page = request('per_page');
        if (in_array($pre_page, [25, 50, 100, 150])) {
            return $pre_page;
        }
        return 25;
    }
}

if (!function_exists('sort_direction')) {
    function sort_direction()
    {
        $direction = request('direction');
        if (in_array($direction, ['asc', 'desc'])) {
            return $direction;
        }
        return 'asc';
    }
}

// if (!function_exists('order_by_column')) {
//     function order_by_column($table)
//     {
//         if (in_array(request('order_by'), get_columns($table))) {
//             return request('order_by');
//         }
//         return 'id';
//     }
// }

// if (!function_exists('get_columns')) {
//     function get_columns($table)
//     {
//         return DB::getSchemaBuilder()->getColumnListing($table);
//     }
// }

if (!function_exists('json_response')) {
    function json_response(
        $status = StatusCode::HTTP_OK,
        $message = "",
        $errors = [],
        $data = [],
        $meta = []
    ) {
        return response([
            'status'  => $status,
            'message'  => $message,
            'errors'  => (array) $errors,
            'data'  => $data,
            'meta'  => $meta,
        ], $status);
    }
}
