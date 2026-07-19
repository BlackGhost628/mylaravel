<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // ===== پنل ادمین =====

    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function pending()
    {
        $articles = Article::pending()->latest()->paginate(10);
        return view('admin.articles.pending', compact('articles'));
    }

    public function create()
    {
        $statuses = Article::getStatuses();
        return view('admin.articles.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'status' => 'required|in:draft,pending,published',
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $count = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }
        $validated['slug'] = $slug;
        $validated['user_id'] = auth()->id() ?? 1;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/articles'), $imageName);
            $validated['image'] = 'images/articles/' . $imageName;
        }

        $validated['published_at'] = $validated['status'] === 'published' ? now() : null;

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'مقاله با موفقیت ذخیره شد!');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $statuses = Article::getStatuses();
        return view('admin.articles.edit', compact('article', 'statuses'));
    }

    /**
     * Update the specified article (با findOrFail برای امنیت بیشتر)
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'status' => 'required|in:draft,pending,published',
        ]);

        // مدیریت Slug
        if ($article->title !== $validated['title']) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $count = 1;
            while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        // مدیریت تصویر
        if ($request->hasFile('image')) {
            if ($article->image && file_exists(public_path($article->image))) {
                unlink(public_path($article->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/articles'), $imageName);
            $validated['image'] = 'images/articles/' . $imageName;
        }

        // مدیریت تاریخ انتشار
        if ($validated['status'] === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        } elseif ($validated['status'] !== 'published') {
            $validated['published_at'] = null;
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'مقاله با موفقیت بروزرسانی شد!');
    }

    /**
     * Publish article (با findOrFail)
     */
    public function publish($id)
    {
        $article = Article::findOrFail($id);

        if ($article->status === 'published') {
            return redirect()->back()->with('error', 'این مقاله قبلاً منتشر شده است.');
        }

        $article->status = 'published';
        $article->published_at = now();
        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'مقاله با موفقیت منتشر شد!');
    }

    /**
     * Remove the specified article (با findOrFail)
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image && file_exists(public_path($article->image))) {
            unlink(public_path($article->image));
        }
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'مقاله حذف شد!');
    }

    // ===== صفحات عمومی (با جستجوی پیشرفته) =====

    public function publicIndex(Request $request)
    {
        $query = Article::where('status', 'published');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('author')) {
            $query->where('author', 'like', "%{$request->author}%");
        }

        switch ($request->sort) {
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'most-viewed':
                $query->orderBy('views', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        $articles = $query->paginate(9)->withQueryString();

        $categories = Article::where('status', 'published')
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->toArray();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function publicShow($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        $article->increment('views');
        return view('articles.show', compact('article'));
    }

    public function search(Request $request)
    {
        $query = Article::where('status', 'published');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->orderBy('published_at', 'asc');
                    break;
                case 'most-viewed':
                    $query->orderBy('views', 'desc');
                    break;
                case 'newest':
                default:
                    $query->orderBy('published_at', 'desc');
                    break;
            }
        }

        $articles = $query->get();
        return response()->json($articles);
    }
}