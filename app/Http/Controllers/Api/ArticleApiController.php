<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleApiController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', 'published')->get();
        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->first();
        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'مقاله یافت نشد'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }
}