from django.urls import path
from django.shortcuts import render
from django.http import JsonResponse, HttpResponse
from django.db.models import Count, Sum, F
from .models import User, Product, Order, OrderItem  
from django.contrib.auth.decorators import login_required
from django.core.paginator import Paginator
import json
def user_table_view(request):
    """نمایش جدول کاربران"""
    users = User.objects.all().order_by('id')
    
    search_query = request.GET.get('search', '')
    if search_query:
        users = users.filter(username__icontains=search_query) | users.filter(email__icontains=search_query)
    
    paginator = Paginator(users, 20)
    page_number = request.GET.get('page', 1)
    page_obj = paginator.get_page(page_number)
    
    context = {
        'table_name': 'کاربران',
        'columns': ['ID', 'نام کاربری', 'ایمیل', 'تاریخ عضویت', 'وضعیت'],
        'rows': page_obj,
        'page_obj': page_obj,
        'search_query': search_query,
    }
    return render(request, 'admin/table_view.html', context)


def product_table_view(request):
    """نمایش جدول محصولات"""
    products = Product.objects.select_related('category').all().order_by('id')
    
    min_stock = request.GET.get('min_stock', '')
    if min_stock.isdigit():
        products = products.filter(stock_quantity__gte=int(min_stock))
    
    paginator = Paginator(products, 20)
    page_number = request.GET.get('page', 1)
    page_obj = paginator.get_page(page_number)
    
    context = {
        'table_name': 'محصولات',
        'columns': ['ID', 'نام محصول', 'دسته‌بندی', 'قیمت', 'موجودی', 'وضعیت'],
        'rows': page_obj,
        'page_obj': page_obj,
    }
    return render(request, 'admin/table_view.html', context)


def order_table_view(request):
    """نمایش جدول سفارشات"""
    orders = Order.objects.select_related('user').prefetch_related('items').all().order_by('-created_at')
    
    for order in orders:
        order.total_amount = order.items.aggregate(total=Sum(F('quantity') * F('unit_price')))['total'] or 0
    
    paginator = Paginator(orders, 20)
    page_number = request.GET.get('page', 1)
    page_obj = paginator.get_page(page_number)
    
    context = {
        'table_name': 'سفارشات',
        'columns': ['ID', 'کاربر', 'تاریخ سفارش', 'مبلغ کل', 'وضعیت پرداخت', 'وضعیت ارسال'],
        'rows': page_obj,
        'page_obj': page_obj,
    }
    return render(request, 'admin/table_view.html', context)


def order_item_table_view(request, order_id=None):
    """نمایش جدول اقلام سفارش - قابل فیلتر بر اساس order_id"""
    items = OrderItem.objects.select_related('product', 'order').all().order_by('order_id', 'id')
    
    if order_id:
        items = items.filter(order_id=order_id)
    
    paginator = Paginator(items, 20)
    page_number = request.GET.get('page', 1)
    page_obj = paginator.get_page(page_number)
    
    context = {
        'table_name': f'اقلام سفارش' + (f' (سفارش #{order_id})' if order_id else ''),
        'columns': ['ID', 'سفارش', 'محصول', 'تعداد', 'قیمت واحد', 'مبلغ کل'],
        'rows': page_obj,
        'page_obj': page_obj,
    }
    return render(request, 'admin/table_view.html', context)


def category_stats_table_view(request):
    """نمایش جدول آماری دسته‌بندی محصولات"""
    from django.db.models import Count, Avg
    
    categories = Product.objects.values('category__id', 'category__name').annotate(
        product_count=Count('id'),
        avg_price=Avg('price'),
        total_stock=Sum('stock_quantity')
    ).order_by('-product_count')
    
    paginator = Paginator(categories, 20)
    page_number = request.GET.get('page', 1)
    page_obj = paginator.get_page(page_number)
    
    context = {
        'table_name': 'آمار دسته‌بندی محصولات',
        'columns': ['شناسه دسته', 'نام دسته', 'تعداد محصولات', 'میانگین قیمت', 'مجموع موجودی'],
        'rows': page_obj,
        'page_obj': page_obj,
    }
    return render(request, 'admin/table_view.html', context)



def api_users(request):
    """API دریافت لیست کاربران به صورت JSON"""
    users = User.objects.all().values('id', 'username', 'email', 'date_joined', 'is_active')
    return JsonResponse(list(users), safe=False)


def api_products(request):
    """API دریافت لیست محصولات به صورت JSON"""
    products = Product.objects.select_related('category').all().values(
        'id', 'name', 'category__name', 'price', 'stock_quantity', 'is_active'
    )
    return JsonResponse(list(products), safe=False)


def api_orders(request):
    """API دریافت لیست سفارشات به صورت JSON با محاسبه مبلغ کل"""
    orders = []
    for order in Order.objects.select_related('user').prefetch_related('items').all():
        total = order.items.aggregate(total=Sum(F('quantity') * F('unit_price')))['total'] or 0
        orders.append({
            'id': order.id,
            'user': order.user.username,
            'user_id': order.user.id,
            'created_at': order.created_at.isoformat(),
            'total_amount': float(total),
            'payment_status': order.payment_status,
            'shipping_status': order.shipping_status,
        })
    return JsonResponse(orders, safe=False)


def api_order_items(request, order_id=None):
    """API دریافت اقلام سفارش - اگر order_id داده شود فقط برای آن سفارش"""
    items = OrderItem.objects.select_related('product', 'order')
    if order_id:
        items = items.filter(order_id=order_id)
    
    data = []
    for item in items:
        data.append({
            'id': item.id,
            'order_id': item.order.id,
            'product_id': item.product.id,
            'product_name': item.product.name,
            'quantity': item.quantity,
            'unit_price': float(item.unit_price),
            'total_price': float(item.quantity * item.unit_price),
        })
    return JsonResponse(data, safe=False)



urlpatterns = [
    # مسیرهای View جدولی (HTML)
    path('tables/users/', user_table_view, name='table_users'),
    path('tables/products/', product_table_view, name='table_products'),
    path('tables/orders/', order_table_view, name='table_orders'),
    path('tables/order-items/', order_item_table_view, name='table_order_items'),
    path('tables/order-items/<int:order_id>/', order_item_table_view, name='table_order_items_by_order'),
    path('tables/category-stats/', category_stats_table_view, name='table_category_stats'),
    
    # مسیرهای API (JSON)
    path('api/users/', api_users, name='api_users'),
    path('api/products/', api_products, name='api_products'),
    path('api/orders/', api_orders, name='api_orders'),
    path('api/order-items/', api_order_items, name='api_order_items'),
    path('api/order-items/<int:order_id>/', api_order_items, name='api_order_items_by_order'),
]