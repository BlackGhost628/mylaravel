<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // ثبت نظر جدید
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:3|max:1000',
            'article_id' => 'required|exists:articles,id',
        ]);

        // بررسی اینکه مقاله وجود دارد و منتشر شده است
        $article = Article::where('id', $request->article_id)
            ->where('status', 'published')
            ->firstOrFail();

        Comment::create([
            'user_id' => Auth::id(),
            'article_id' => $request->article_id,
            'content' => $request->content,
            'is_approved' => false, // نیاز به تایید ادمین دارد
        ]);

        return redirect()->back()->with('success', 'نظر شما با موفقیت ثبت شد و پس از تایید نمایش داده می‌شود.');
    }

    // حذف نظر (فقط برای کاربر خودش)
    public function destroy($id)
    {
        $comment = Comment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $comment->delete();

        return redirect()->back()->with('success', 'نظر شما با موفقیت حذف شد.');
    }
}