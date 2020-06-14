<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    //
    public function index()
    {
        $prooucts = Product::all()->first();
        $categories = Category::all()->first();
        $brands = Brand::all()->first();

        return response()->view('frontend.sitemaps.index', [
            'products' => $prooucts,
            'categories' => $categories,
            'brands' => $brands,
        ])->header('Content-Type', 'text/xml');
    }


    public function products()
    {
        $products = Product::latest()->get();

        return response()->view('frontend.sitemaps.products', [
            'products' => $products,
        ])->header('Content-Type', 'text/xml');

    }

    public function categories()
    {
        $categories = Category::all();
        return response()->view('frontend.sitemaps.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    public function brands()
    {
        $brands = Brand::latest()->get();
        return response()->view('frontend.sitemaps.brands', [
            'brands' => $brands,
        ])->header('Content-Type', 'text/xml');
    }
}
