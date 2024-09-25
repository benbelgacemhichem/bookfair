<?php

namespace App\Livewire;

use App\Models\Visitor;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Order extends Component
{

    use LivewireAlert;

    public $orders = [];
    public $selectedOrder = '';
    public $orderCanceledMsg = '';
    public $orderPrintingMsg = '';
    public $orderDeliveredMsg = '';
    public $orderStatus = [];

    public function mount() {
        $this->orders = collect(Visitor::where('type', 'Bag')->with('book')->orderBy('id', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        }));
    
        $this->orderStatus = $this->orders->pluck('status')->toArray();
    }

    public function render()
    {
        $this->orders = collect(Visitor::where('type', 'Bag')->with('book')->orderBy('id', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        }));

        return view('livewire.order', ['orders' => $this->orders]);
    }

    // #[On('echo:orders,OrderPrint')]
    public function showOrder($orderId) {
        $this->orders = collect(Visitor::where('type', 'Bag')->with('book')->orderBy('id', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        }));

        $this->alert('success', 'New order submitted');
    }

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

    public function proceedOrder($id){
        $order = Visitor::where('id', $id)->first();
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
