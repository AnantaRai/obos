<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('order_product')->select('product_id', DB::raw('COUNT(product_id) as count'))->groupBy('product_id')->orderBy('count', 'desc')->get();
        $product_ids = [];
        foreach($products as $product) {
            array_push($product_ids, $product->product_id);
        }
        $product_count = [];
        foreach($products as $product) {
            array_push($product_count, $product->count);
        }
        $placeholders = implode(',',array_fill(0, count($product_ids), '?')); // string for the query

        $topProducts = Product::whereIn('id', $product_ids)->orderByRaw("field(id,{$placeholders})", $product_ids)->get();
        $i=0;
        foreach($topProducts as $topProduct) {
            $topProduct->count = $product_count[$i];
            $i+=1;
        }


        return view('reports', compact('topProducts', 'product_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
