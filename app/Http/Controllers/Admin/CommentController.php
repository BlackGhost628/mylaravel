<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // لیست نظرات (همه)
    public function index()
    {
        $comments = Comment::with(['user', 'article'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    // نظرات در انتظار تایید
    public function pending()
    {
        $comments = Comment::with(['user', 'article'])
            ->where('is_approved', false)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.comments.pending', compact('comments'));
    }

    // تایید نظر
    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_approved = true;
        $comment->save();

        return redirect()->back()->with('success', 'نظر با موفقیت تایید شد.');
    }

    // حذف نظر
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'نظر با موفقیت حذف شد.');
    }
}