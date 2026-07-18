<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache; // ← اضافه شده

class AdminController extends Controller
{
    // ========== داشبورد ==========
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalContacts = Contact::count();
        $unreadContacts = Contact::where('is_read', false)->count();
        $recentProducts = Product::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalContacts',
            'unreadContacts',
            'recentProducts',
            'recentContacts'
        ));
    }

    // ========== مدیریت محصولات ==========
    
    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.create-product');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'boolean'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $imageName);
            $data['image'] = $imageName;
        }

        Product::create($data);

        // ===== پاک کردن کش صفحه اصلی =====
        Cache::forget('featured_products');
        Cache::forget('latest_products');
        Cache::forget('popular_products');

        return redirect()->route('admin.products')->with('success', 'محصول با موفقیت اضافه شد!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('image/' . $product->image))) {
                unlink(public_path('image/' . $product->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        // ===== پاک کردن کش صفحه اصلی =====
        Cache::forget('featured_products');
        Cache::forget('latest_products');
        Cache::forget('popular_products');

        return redirect()->route('admin.products')->with('success', 'محصول با موفقیت بروزرسانی شد!');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->image && file_exists(public_path('image/' . $product->image))) {
            unlink(public_path('image/' . $product->image));
        }
        
        $product->delete();

        // ===== پاک کردن کش صفحه اصلی =====
        Cache::forget('featured_products');
        Cache::forget('latest_products');
        Cache::forget('popular_products');

        return redirect()->route('admin.products')->with('success', 'محصول با موفقیت حذف شد!');
    }

    // ========== مدیریت پیام‌ها ==========
    
    public function contacts()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.contacts', compact('contacts'));
    }

    public function showContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->is_read = true;
        $contact->save();
        return view('admin.contact-detail', compact('contact'));
    }

    public function deleteContact($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.contacts')->with('success', 'پیام با موفقیت حذف شد!');
    }
}