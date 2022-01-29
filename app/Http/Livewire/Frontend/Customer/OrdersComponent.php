<?php

namespace App\Http\Livewire\Frontend\Customer;

use App\Models\Order;
use App\Models\OrderTransactions;
use Livewire\Component;

class OrdersComponent extends Component
{

    public $showOrder = false;
    public $order;


    public function showOrderDetails($id)
    {
        $this->order = Order::with('products')->find($id);
        $this->showOrder = true;

        //return $this->redirect()->route('index');

    }

    public function requestRefundOrder($id)
    {

        $order = Order::find($id);
        $order->update([
            'order_status' => Order::REFUNDED_REQUEST,
        ]);

        $order->transactions()->create([
            'transaction' => OrderTransactions::REFUNDED_REQUEST,
            'transaction_number' => OrderTransactions::where('order_id', $order->id)
                ->where('transaction', OrderTransactions::PAYMENT_COMPLETED)->first()->transaction_number,
            'payment_result' => '',
        ]);


        $this->alert('success', 'Your Request Send Successfully');

    }

    public function render()
    {
        return view('livewire.frontend.customer.orders-component', [
            'orders' => Order::where('user_id', auth()->id())->orderBy('id', 'desc')->get(),
        ]);
    }
}
