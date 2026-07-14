<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // فقط اگر ستون وجود نداشته باشد، اضافه کن
        if (!Schema::hasColumn('orders', 'tracking_code')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('tracking_code')->nullable()->after('order_number');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('orders', 'tracking_code')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('tracking_code');
            });
        }
    }
};