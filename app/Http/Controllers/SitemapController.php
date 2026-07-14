<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Article;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $articles = Article::where('status', 'published')->get();

        return response()->view('sitemap', compact('products', 'articles'))
            ->header('Content-Type', 'text/xml');
    }
}