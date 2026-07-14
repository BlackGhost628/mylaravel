<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    // ===== نمایش فرم تسک‌آوت (checkout) =====
    public function checkout()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'سبد خرید شما خالی است!');
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('orders.checkout', compact('cart', 'total'));
    }

    // ===== ثبت سفارش =====
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|min:10',
            'phone' => 'required|string|min:10',
            'notes' => 'nullable|string',
        ]);

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'سبد خرید شما خالی است!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());
$trackingCode = Order::generateTrackingCode(); // ← جدید

$order = Order::create([
    'user_id' => Auth::id(),
    'order_number' => $orderNumber,
    'tracking_code' => $trackingCode, // ← جدید
    'total_price' => $total,
    'status' => 'pending',
    'address' => $request->address,
    'phone' => $request->phone,
    'notes' => $request->notes,
]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        Session::forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'سفارش شما با موفقیت ثبت شد! شماره پیگیری: ' . $orderNumber);
    }

    // ===== نمایش لیست سفارش‌های کاربر =====
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    // ===== نمایش جزئیات یک سفارش =====
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->findOrFail($id);
        
        return view('orders.show', compact('order'));
    }

    // ===== مدیریت سفارش‌ها در پنل ادمین =====
    public function adminIndex()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders', compact('orders'));
    }

    // ===== نمایش جزئیات سفارش در پنل ادمین =====
    public function adminShow($id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($id);
        return view('admin.order-detail', compact('order'));
    }

    // ===== تغییر وضعیت سفارش =====
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'وضعیت سفارش با موفقیت تغییر کرد!');
    }

    // ===== حذف سفارش (فقط ادمین) =====
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'سفارش با موفقیت حذف شد!');
    }

    // نمایش فرم پیگیری سفارش
public function trackForm()
{
    return view('orders.track');
}

// پردازش پیگیری سفارش با کد رهگیری
public function track(Request $request)
{
    $request->validate([
        'tracking_code' => 'required|string|exists:orders,tracking_code',
    ]);

    $order = Order::where('tracking_code', $request->tracking_code)
        ->with('items.product')
        ->first();

    return view('orders.track', compact('order'));
}




}