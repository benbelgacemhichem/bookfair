<?php

namespace App\Livewire;

use App\Models\Visitor;
use Livewire\Attributes\On;
use Livewire\Component;

class Order extends Component
{

    public $orders = [];
    public $selectedOrder = '';
    public $orderCanceledMsg = '';
    public $orderPrintingMsg = '';
    public $orderDeliveredMsg = '';
    public $orderStatus = [];

    public function mount() {
        $this->orders = Visitor::where('type', 'Bag')->with('book')->orderBy('id', 'desc')->get();
        $this->orderStatus = $this->orders->pluck('status')->toArray();
    }

    public function render()
    {
        $this->orders = Visitor::where('type', 'Bag')->with('book')->orderBy('id', 'desc')->get();
        return view('livewire.order', ['orders' => $this->orders]);
    }

    // #[On('echo:orders,OrderPrint')]
    // public function showOrder($orderId) {
    //     dd(1);
    //     $this->orders = Visitor::with('book')->get();
    // }

    public function getOrderId($id){
        $this->orderCanceledMsg = '';
        $this->orderPrintingMsg = '';
        $this->orderDeliveredMsg = '';
        $this->selectedOrder = $id;
    }

    public function cancelOrder(){
        $order = Visitor::where('id', $this->selectedOrder)->first();
        $order->status = 'canceled';
        $order->save();
        $this->orderCanceledMsg = 'the order has been cancelled';
    }

    public function proceedOrder(){
        $order = Visitor::where('id', $this->selectedOrder)->first();
        $order->status = 'printing';
        $order->save();
        $this->orderPrintingMsg = 'Printing is in progress';
    }

    public function orderPrinted(){
        $order = Visitor::where('id', $this->selectedOrder)->first();
        $order->status = 'printed';
        $order->save();
        $this->orderDeliveredMsg = 'The order has been printed successfully';
    }

    public function orderDelivered(){
        $order = Visitor::where('id', $this->selectedOrder)->first();
        $order->status = 'delivered';
        $order->save();
        $this->orderDeliveredMsg = 'The order has been delivered';
    }
}
