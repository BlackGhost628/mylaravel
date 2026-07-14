<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // نمایش همه محصولات با جستجوی پیشرفته
    public function index(Request $request)
    {
        $query = Product::query();

        // ===== جستجوی متنی =====
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // ===== فیلتر دسته‌بندی =====
        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        // ===== فیلتر قیمت (حداقل) =====
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // ===== فیلتر قیمت (حداکثر) =====
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // ===== فیلتر محصولات ویژه =====
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured == 'true');
        }

        // ===== مرتب‌سازی =====
        switch ($request->sort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name-asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name', 'desc');
                break;
            case 'likes':
                $query->orderBy('likes', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // ===== صفحه‌بندی =====
        $products = $query->paginate(12)->withQueryString();

        // ===== دریافت لیست دسته‌بندی‌ها برای فیلتر =====
        $categories = Product::select('category')
            ->distinct()
            ->pluck('category')
            ->toArray();

        return view('products', compact('products', 'categories'));
    }

    // نمایش محصولات ویژه برای صفحه اصلی
    public function featured()
    {
        $featuredProducts = Product::where('is_featured', true)->take(8)->get();
        $latestProducts = Product::latest()->take(8)->get();
        $popularProducts = Product::orderBy('likes', 'desc')->take(8)->get();
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

    // نمایش یک محصول خاص
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }

    // جستجوی Ajax (برای جستجوی زنده)
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
                case 'price-asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name-asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name-desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $products = $query->get();
        return response()->json($products);
    }
}