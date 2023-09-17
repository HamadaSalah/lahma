@extends('layouts.app')

@section('content')
<div class="slider sliderProducts">
    <div class="container">
        <div class="row">
            <div class="intro">
                <h1 style="text-align: center;">سلة المنتجات
                </h1>
            </div>
        </div>
    </div>
</div>
<section>
    <form action="{{Route('checkout')}}" method="GET">
        @csrf
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    @if($orders && $orders->count() > 0)
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-12">
                                        <div class="p-5">
                                            @php
                                                $total = 0;
                                            @endphp
                                            {{-- @dd($orders) --}}
                                            @foreach($orders as $order)
                                            <span style="background: red;color: #fff;padding: 5px;border-radius: 5px;margin-bottom: 10px;display: inline-block">
                                                اوردر بتاريخ {{$order->created_at}}
                                            </span>
                                            @foreach ($order->products as $myproductt)
                                                 <div
                                                    class="row mb-5 d-flex justify-content-between align-items-center Oneorder">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <img src="{{ asset("uploads/".$myproductt->img) }}"
                                                            class="img-fluid rounded-3" style="max-height: 100px">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        <h6 class="text-muted">
                                                            {{ $myproductt->product->name }}</h6>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                        العدد
                                                        <input id="form1" min="0" name="quantity"
                                                            value="{{ $myproductt->count }}"
                                                            type="number" class="form-control form-control-sm" disabled
                                                            style="background: 0;border: 0;text-align: center;font-weight: bold;width: 30px" />

                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <h6 class="mb-0">
                                                            @if (isset($myproductt->sub_product_id) && $myproductt->sub_product_id!="")
                                                            {{ getPrice($myproductt->sub_product_id)*$myproductt->count ?? getPrice($myproductt->product_id)*$myproductt->count }}
                                                            @else
                                                            {{ getPrice($myproductt->product_id)*$myproductt->count }}

                                                            @endif
                                                            ريال </h6>
                                                    </div>
                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">

                                                    </div>
                                                </di
                                            @endforeach
                                               v>
                                            @endforeach

                                            <hr class="my-4">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <center>لا يوجد</center>
                    @endif
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
