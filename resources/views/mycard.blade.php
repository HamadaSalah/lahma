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
                    @if($carts)
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-12">
                                        <div class="p-5">
                                            @php
                                                $total = 0;
                                            @endphp
                                            {{-- @dd($carts) --}}
                                            @foreach($carts as $cart)
                                            <?php 
                                            if(isset($cart['subProduct'])) {
                                                $total = $total +( getPrice($cart['subProduct'])*$cart['count']);

                                            }
                                            else {
                                                $total = $total +( getPrice($cart['product_id']));
                                            }
                                            ?>
    
                                                <div
                                                    class="row mb-4 d-flex justify-content-between align-items-center OneCart">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <img src="{{ asset("uploads/".$cart['product_img']) }}"
                                                            class="img-fluid rounded-3" style="max-height: 100px">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        <h6 class="text-muted">
                                                            {{ $cart['product_name'] }}</h6>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                        العدد
                                                        <input id="form1" min="0" name="quantity"
                                                            value="{{ $cart['count'] ?? 1 }}"
                                                            type="number" class="form-control form-control-sm" disabled
                                                            style="background: 0;border: 0;text-align: center;font-weight: bold;width: 30px" />

                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <h6 class="mb-0">
                                                            @if (isset($cart['subProduct']))
                                                                
                                                            {{ getPrice($cart['subProduct'])*$cart['count'] ?? getPrice($cart['product_id'])*$cart['count'] }}
                                                            @else
                                                            {{ getPrice($cart['product_id']) }}

                                                            @endif
                                                            ريال </h6>
                                                    </div>
                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                        <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <hr class="my-4">

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h1 class="text-center" style="color: red">{{$total}} ر.س</h1>
                                        <button type="submit" style="display: block;width: 100%" class="btn btn-success mb-3" >الدفع</button>
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
@push('myscripts')
    
@endpush
@endsection
