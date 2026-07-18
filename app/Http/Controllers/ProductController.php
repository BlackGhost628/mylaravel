<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // جستجو، فیلتر و مرتب‌سازی (همان کد قبلی)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured == 'true');
        }

        switch ($request->sort) {
            case 'price-asc': $query->orderBy('price', 'asc'); break;
            case 'price-desc': $query->orderBy('price', 'desc'); break;
            case 'name-asc': $query->orderBy('name', 'asc'); break;
            case 'name-desc': $query->orderBy('name', 'desc'); break;
            case 'likes': $query->orderBy('likes', 'desc'); break;
            default: $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Product::select('category')->distinct()->pluck('category')->toArray();

        return view('products', compact('products', 'categories'));
    }

    public function featured()
    {
        // ===== کش کردن کوئری‌ها =====
        $featuredProducts = Cache::remember('featured_products', 3600, function () {
            return Product::where('is_featured', true)->take(8)->get();
        });

        $latestProducts = Cache::remember('latest_products', 3600, function () {
            return Product::latest()->take(8)->get();
        });

        $popularProducts = Cache::remember('popular_products', 3600, function () {
            return Product::orderBy('likes', 'desc')->take(8)->get();
        });

        $categories = Product::select('category')
            ->selectRaw('count(*) as count')
            ->groupBy('category')
            ->get();

        return view('home', compact(
            'featuredProducts',
            'latestProducts',
            'popularProducts',
            'categories'
        ));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price-asc': $query->orderBy('price', 'asc'); break;
                case 'price-desc': $query->orderBy('price', 'desc'); break;
                case 'name-asc': $query->orderBy('name', 'asc'); break;
                case 'name-desc': $query->orderBy('name', 'desc'); break;
                default: $query->orderBy('created_at', 'desc');
            }
        }

        $products = $query->get();
        return response()->json($products);
    }
}