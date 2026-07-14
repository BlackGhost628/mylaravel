@props([
    'route' => '#',
    'placeholder' => 'جستجو...',
    'categories' => [],
    'showCategory' => true,
    'showSort' => true,
    'showPrice' => false,
    'showFeatured' => false,
])

<form method="GET" action="{{ $route }}" style="background:white;padding:12px 20px;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #e9ecef;margin-bottom:25px;">

    <div style="display:flex;flex-wrap:wrap;align-items:center;gap:10px;">

        {{-- جستجوی متنی --}}
        <div style="flex:2;min-width:180px;">
            <div style="position:relative;display:flex;align-items:center;background:#f8f9fa;border-radius:8px;border:2px solid #e9ecef;transition:border-color 0.3s;">
                <span style="padding:0 12px;color:#adb5bd;">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}" 
                       style="width:100%;padding:10px 12px;border:none;background:transparent;font-size:14px;outline:none;color:#2D2D2D;"
                       placeholder="{{ $placeholder }}">
            </div>
        </div>

        {{-- دسته‌بندی --}}
        @if($showCategory && count($categories) > 0)
        <div style="flex:1;min-width:140px;">
            <select name="category" style="width:100%;padding:10px 12px;border:2px solid #e9ecef;border-radius:8px;font-size:14px;background:#f8f9fa;color:#2D2D2D;outline:none;transition:border-color 0.3s;cursor:pointer;">
                <option value="all">📂 همه دسته‌ها</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        @endif

        {{-- مرتب‌سازی --}}
        @if($showSort)
        <div style="flex:1;min-width:130px;">
            <select name="sort" style="width:100%;padding:10px 12px;border:2px solid #e9ecef;border-radius:8px;font-size:14px;background:#f8f9fa;color:#2D2D2D;outline:none;transition:border-color 0.3s;cursor:pointer;">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>🔄 جدیدترین</option>
                <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>💰 قیمت کم→زیاد</option>
                <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>💰 قیمت زیاد→کم</option>
                <option value="most-viewed" {{ request('sort') == 'most-viewed' ? 'selected' : '' }}>👁️ پربازدیدترین</option>
            </select>
        </div>
        @endif

        {{-- قیمت (حداقل) --}}
        @if($showPrice)
        <div style="flex:0.7;min-width:100px;">
            <input type="number" name="min_price" value="{{ request('min_price') }}" 
                   style="width:100%;padding:10px 12px;border:2px solid #e9ecef;border-radius:8px;font-size:14px;background:#f8f9fa;color:#2D2D2D;outline:none;transition:border-color 0.3s;"
                   placeholder="قیمت از">
        </div>
        <div style="flex:0.7;min-width:100px;">
            <input type="number" name="max_price" value="{{ request('max_price') }}" 
                   style="width:100%;padding:10px 12px;border:2px solid #e9ecef;border-radius:8px;font-size:14px;background:#f8f9fa;color:#2D2D2D;outline:none;transition:border-color 0.3s;"
                   placeholder="قیمت تا">
        </div>
        @endif

        {{-- محصولات ویژه --}}
        @if($showFeatured)
        <div style="display:flex;align-items:center;gap:6px;padding:0 5px;">
            <label style="display:flex;align-items:center;gap:6px;font-size:13px;font-weight:500;color:#495057;cursor:pointer;">
                <input type="checkbox" name="is_featured" value="true" {{ request('is_featured') == 'true' ? 'checked' : '' }}
                       style="width:17px;height:17px;accent-color:#FF385C;cursor:pointer;">
                ⭐ ویژه
            </label>
        </div>
        @endif

        {{-- دکمه‌ها --}}
        <div style="display:flex;gap:6px;">
            <button type="submit" style="padding:10px 22px;background:#FF385C;color:white;border:none;border-radius:8px;font-weight:600;font-size:14px;cursor:pointer;transition:background 0.3s,transform 0.2s;white-space:nowrap;">
                🔍 جستجو
            </button>
            <a href="{{ $route }}" style="padding:10px 18px;background:#f1f3f5;color:#495057;border:none;border-radius:8px;font-weight:500;font-size:14px;text-decoration:none;cursor:pointer;transition:background 0.3s;white-space:nowrap;">
                ✖️ پاک کردن
            </a>
        </div>
    </div>
</form>