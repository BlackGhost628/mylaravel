<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Support\Facades\Log;

class SendOrderNotificationToAdmin
{
    public function handle(OrderPlaced $event): void
    {
        Log::info('New order placed: ' . $event->order->order_number);
    }
}