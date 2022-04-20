<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\ChartsService;

class DashboardApiController extends Controller
{
    public function index()
    {
        $latest0 = new ChartsService([
            'title'        => 'Category List',
            'chart_type'   => 'latest',
            'model'        => 'App\Models\Category',
            'column_class' => 'col-md-6',
            'fields'       => ['name'],
            'limit'        => 5,
        ]);

        $line1 = new ChartsService([
            'title'           => 'Blog Chart',
            'chart_type'      => 'line',
            'model'           => 'App\Models\Blog',
            'group_by_field'  => 'created_at',
            'group_by_period' => 'month',
            'column_class'    => 'col-md-6',
        ]);

        return response()->json(compact('latest0', 'line1'));
    }
}
