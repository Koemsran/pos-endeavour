<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class OrderController extends Controller
{

    //=====================Listing Order =====================//
    public function index(Request $request)
    {
        $ordersQuery = Order::query();
        $filter = $request->input('filter');

        switch ($filter) {
            case 'last-month':
                $ordersQuery->whereMonth('created_at', now()->subMonth()->month);
                $ordersQuery->whereYear('created_at', now()->subMonth()->year);
                break;
            case 'last-week':
                $ordersQuery->whereBetween('created_at', [now()->subWeek(), now()]);
                break;
            case 'today':
                $ordersQuery->whereDate('created_at', today());
                break;
            default:
                // Optionally handle other cases or set a default query
                break;
        }

        $orders = $ordersQuery->with(['user', 'products.colors', 'products.sizes'])->get();

        return view('setting.orders.index', compact('orders'));
    }
    
    //===========================Show specific order products =================//
    public function show($id)
    {
        $order = Order::with(['user', 'products.colors', 'products.sizes'])->find($id);

        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Order not found');
        }

        return view('setting.orders.show', compact('order'));
    }
    //=====================Cancel Order =================//
    public function cancel($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }

        $order->order_status = 'cancelled';
        $order->save();

        $this->createNotification($order->user_id, 'order_cancelled', 'Your order has been cancelled.', $order->id);

        return redirect()->route('admin.orders.index')->with('success', 'Order cancelled successfully');
    }

    //=====================Confirm Order =================//
    public function confirm($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }

        $order->order_status = 'confirmed';
        $order->save();

        $this->createNotification($order->user_id, 'order_confirmed', 'Your order has been confirmed.', $order->id);

        return redirect()->route('admin.orders.index')->with('success', 'Order confirmed successfully');
    }

    //=====================Create notification =================//
    private function createNotification($userId, $type, $text, $orderId)
    {
        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->notification_type = $type;
        $notification->notification_text = $text;
        $notification->notification_data = $orderId;
        $notification->read = false;
        $notification->save();
    }

}
