<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Models\Order;
use Livewire\Component;

class StatisticesComponent extends Component
{

    public $currentMonthEarning = 0;
    public $currentAnnualEarning = 0;
    public $currentMonthNewOrders = 0;
    public $currentMonthOrdersFinished = 0;

    public function mount()
    {
        $this->currentMonthEarning = Order::where('order_status', Order::FINISHED)->whereMonth('created_at', date('m'))->sum('total');
        $this->currentAnnualEarning = Order::whereOrderStatus(Order::FINISHED)->whereYear('created_at', date('Y'))->sum('total');
        $this->currentMonthNewOrders = Order::whereOrderStatus(Order::NEW_ORDER)->whereMonth('created_at', date('m'))->count();
        $this->currentMonthOrdersFinished = Order::whereOrderStatus(Order::NEW_ORDER)->whereYear('created_at', date('Y'))->count();
    }

    public function render()
    {
        return view('livewire.backend.dashboard.statistices-component');
    }
}
