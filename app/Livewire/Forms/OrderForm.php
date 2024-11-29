<?php

namespace App\Livewire\Forms;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Form;

class OrderForm extends Form
{
    public $payment_method = '';
    public $cart_items = [];
    public $total_price = 0;
    public $discount = 0;
    public $net_price = 0;

    public function rules()
    {
        return [
            'payment_method' => 'required|in:credit_card,bank_transfer,cash',
        ];
    }

    public function setCartItems($items)
    {
        $this->cart_items = $items;
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->total_price = collect($this->cart_items)->sum('price');
        $this->discount = collect($this->cart_items)->sum('discount');
        $this->net_price = collect($this->cart_items)->sum('net_price');
    }

    public function createOrder($userId)
    {
        $this->validate();

        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $this->total_price,
            'discount' => $this->discount,
            'net_price' => $this->net_price,
            'payment_method' => $this->payment_method,
            'payment_status' => 'pending',
            'status' => 'pending',
            'customer_ip' => request()->ip(),
        ]);

        // Create order items
        foreach ($this->cart_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'course_id' => $item['course_id'],
                'price' => $item['price'],
                'discount' => $item['discount'] ?? 0.00,
                'net_price' => $item['net_price'],
            ]);
        }

        return $order;
    }
}
