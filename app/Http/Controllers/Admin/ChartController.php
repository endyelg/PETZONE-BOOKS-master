<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ChartController extends Controller
{
    public function pieChart()
    {
        $result = DB::table('CATEGORIES as c')
                    ->leftJoin('PRODUCTS as p', 'c.id', '=', 'p.category_id')
                    ->select(DB::raw('c.title AS category_title, COUNT(p.id) AS products_count'))
                    ->groupBy('c.id', 'c.title')
                    ->get();

        $labels = [];
        $data = [];

        foreach ($result as $val) {
            $labels[] = $val->category_title;
            $data[] = $val->products_count;
        }

        return response()->json(['data' => $data, 'labels' => $labels]);
    }


    public function lineChart()
    {
        $result = DB::table('ORDERS as o')
                    ->join('ORDER_PRODUCT as op', 'o.id', '=', 'op.order_id')
                    ->select(DB::raw("DATE_FORMAT(o.date_placed, '%M') AS month, SUM(o.price) AS total_sales"))
                    ->groupBy(DB::raw("DATE_FORMAT(o.date_placed, '%M')"))
                    ->orderBy(DB::raw("MONTH(o.date_placed)"))
                    ->get();

        $labels = [];
        $data = [];

        foreach ($result as $val) {
            $labels[] = $val->month;
            $data[] = $val->total_sales;
        }

        return response()->json(['data' => $data, 'labels' => $labels]);
    }

    public function barChart()
    {
        $result = DB::table('CATEGORIES as c')
                    ->join('PRODUCTS as p', 'c.id', '=', 'p.category_id')
                    ->join('ORDER_PRODUCT as op', 'p.id', '=', 'op.product_id')
                    ->join('ORDERS as o', 'op.order_id', '=', 'o.id')
                    ->select(DB::raw('c.title AS category, SUM(o.price) AS total_sales'))
                    ->groupBy('c.title')
                    ->get();

        $labels = [];
        $data = [];

        foreach ($result as $val) {
            $labels[] = $val->category;
            $data[] = $val->total_sales;
        }

        return response()->json(['data' => $data, 'labels' => $labels]);
    }
}

