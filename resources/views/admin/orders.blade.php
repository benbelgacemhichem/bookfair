@extends('admin.layouts.app')

<meta http-equiv="refresh" content="10">
@section('content')
    <div class="m-2">
        <div class="">
            <section class="highlights">
                <div class="row w-100 m-0 ">
                    @foreach ($orders as $key => $orders_list)
                        <div>
                            <h3>Date: {{ $key }} ({{ $orders_list->count() }})</h3>
                        </div>
                        @foreach ($orders_list as $key => $order)
                            <div class="col-lg-3 col-md-3 col-sm-3 mb-4 d-flex align-items-stretch"
                                @if ($order->status == 'canceled' || $order->status == 'delivered') style="opacity: 0.5" @endif>
                                <div class="card w-100" style="background: white;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h3 class="card-title">Type: {{ $order->type }}</h3>
                                            </div>
                                            <div class="col-md-4 text-end">
                                                @if ($order->status == 'canceled')
                                                    <span class="badge bg-danger p-2 text-uppercase">{{ $order->status }}</span>
                                                @endif
                                                @if ($order->status == 'printing')
                                                    <span class="badge bg-warning p-2 text-uppercase">Printing</span>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($order->book)
                                            <h3 class="card-text">Book: {{ $order->book->name }}</h3>
                                        @endif
                                        @if ($order->type == 'Bag')
                                            <h3 class="card-text">BagStyle: {{ $order->bag_style }}</h3>
                                        @endif
                                        <p class="card-text">Vistor name: {{ $order->full_name }}</p>
                                        <p class="card-text">Vistor phone: {{ $order->phone_number }}</p>
                                        <p class="card-text">Vistor email: {{ $order->email }}</p>
                                        <p class="card-text">Order Time: {{ $order->created_at->format('d/m/Y - H:i') }}</p>
                                        <h3 class="card-text">Content: <span
                                                style="color:blue">"{{ $order->bag_content }}"</span></h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            @if ($order->status == 'printed')
                                                <div class="col-md-12">
                                                    <button class="btn btn-info text-white text-uppercase w-100"
                                                        data-bs-toggle="modal" data-bs-target="#deliveredModal"
                                                        wire:click="getOrderId({{ $order->id }})">Delivered</button>
                                                </div>
                                            @elseif($order->status == 'delivered')
                                                <div class="col-md-12">
                                                    <button class="disabled btn btn-success text-uppercase w-100">Order
                                                        Delivered</button>
                                                </div>
                                            @else
                                                <div class="col-md-6">
                                                    @if ($order->status == 'submitted')
                                                        <a href=""
                                                            class="btn btn-primary w-100 text-uppercase @if ($order->status == 'canceled') disabled @endif"
                                                            data-bs-toggle="modal" data-bs-target="#proceedModal"
                                                            wire:click="getOrderId({{ $order->id }})">Proceed</a>
                                                    @else
                                                        <a href="" class="btn btn-success w-100 text-uppercase"
                                                            data-bs-toggle="modal" data-bs-target="#printedModal"
                                                            wire:click="getOrderId({{ $order->id }})">Printed</a>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <a href=""
                                                        class="btn btn-danger w-100 text-uppercase @if ($order->status == 'canceled') disabled @endif"
                                                        data-bs-toggle="modal" data-bs-target="#cancelModal"
                                                        wire:click="getOrderId({{ $order->id }})">Cancel</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                        @endforeach
                        <div class="container">
                            <hr>
                        </div>
                    @endforeach
                </div>
            </section>
        
            <!-- Proceed Modal -->
            <div class="modal fade" id="proceedModal" tabindex="-1" aria-labelledby="proceedModalLabel" aria-hidden="true"
                wire:ignore>
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-5 text-center">
                            <h4 class="text-dark">Are you sure to proceed ?</h4>
                            <div class="row mt-5">
                                <div class="col-md-6"><button class="btn btn-sm btn-outline-danger text-uppercase w-100"
                                        data-bs-dismiss="modal">Cancel</button> </div>
                                <div class="col-md-6"><button class="btn btn-sm btn-primary text-uppercase w-100"
                                        data-bs-dismiss="modal" wire:click="proceedOrder()"> Yes, Proceed</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Proceed Modal -->
        
            <!-- Cancel Modal -->
            <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true"
                wire:ignore>
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-5 text-center">
                            <h4 class="text-dark">Are you sure to cancel this order ?</h4>
                            <div class="row mt-5">
                                <div class="col-md-6"><button class="btn btn-sm btn-outline-danger text-uppercase w-100"
                                        data-bs-dismiss="modal">No</button> </div>
                                <div class="col-md-6"><button class="btn btn-sm btn-primary text-uppercase w-100"
                                        wire:click="cancelOrder()" data-bs-dismiss="modal"> Yes</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Cancel Modal -->
        
            <!-- Printed Modal -->
            <div class="modal fade" id="printedModal" tabindex="-1" aria-labelledby="printedModalLabel" aria-hidden="true"
                wire:ignore>
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-5 text-center">
                            <h4 class="text-dark">Order printed ?</h4>
                            <div class="row mt-5">
                                <div class="col-md-6"><button class="btn btn-sm btn-outline-danger text-uppercase w-100"
                                        data-bs-dismiss="modal">No</button> </div>
                                <div class="col-md-6"><button class="btn btn-sm btn-primary text-uppercase w-100"
                                        wire:click="orderPrinted()" data-bs-dismiss="modal"> Yes</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Printed Modal -->
        
            <!-- Delivered Modal -->
            <div class="modal fade" id="deliveredModal" tabindex="-1" aria-labelledby="deliveredModalLabel"
                aria-hidden="true" wire:ignore>
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-5 text-center">
                            <h4 class="text-dark">Order Delivered ?</h4>
                            <div class="row mt-5">
                                <div class="col-md-6"><button class="btn btn-sm btn-outline-danger text-uppercase w-100"
                                        data-bs-dismiss="modal">No</button> </div>
                                <div class="col-md-6"><button class="btn btn-sm btn-primary text-uppercase w-100"
                                        wire:click="orderDelivered()" data-bs-dismiss="modal"> Yes</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delivered Modal -->
        </div>
    </div>
@endsection


