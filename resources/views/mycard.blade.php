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
            <div class="row  justify-content-center align-items-center h-100">
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
                                            @foreach($carts as $key => $cart)
                                            <?php 
                                            if(isset($cart['subProduct'])) {
                                                $total = $total +( getPrice($cart['subProduct'] ?? $cart['product_id'])*$cart['count']);
                                            }
                                            else {
                                                 $total = $total +( getPrice($cart['product_id'])*$cart['count']);
                                            }
                                            ?>
    
                                                <div
                                                    class="row mb-4   justify-content-between align-items-center OneCart">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <img src="{{ asset("uploads/".$cart['product_img']) }}"
                                                            class="img-fluid rounded-3" style="max-height: 100px">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        <h6 class="text-muted">
                                                            {{ $cart['product_name'] }}</h6>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-2  ">
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
                                                            {{ getPrice($cart['product_id'])*$cart['count'] }}

                                                            @endif
                                                            ريال </h6>
                                                    </div>
                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                        <a href="#!" class="text-muted RemoveElement" data-id="{{$key}}"><i class="fas fa-times"></i></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <hr class="my-4">

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h1 class="text-center" style="color: red">{{$total}} ر.س</h1>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: block;width: 100%" class="btn btn-success mb-3" >الدفع</button>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">اطلب الان</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{Route('checkout')}}" method="GET">
                @csrf
                <!-- Name Input -->
                <div class="mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="الاسم" required>
                </div>
        
                <!-- Address Input -->
                <div class="mb-3">
                    <label for="address" class="form-label">العنوان</label>
                    <input type="text" class="form-control" id="address"  name="address" placeholder="العنوان" required>
                </div>
        
                <!-- Pay Type Select -->
                <div class="mb-3">
                    <label for="city" class="form-label"  >المدينة</label>
                    <select class="form-select" id="city" name="city" required>
                        <option value="" selected disabled>اختر مدينتك</option>
                        <option value="الدمام">الدمام</option>
                        <option value="الخبر">الخبر</option>
                        <option value="الظهران">الظهران</option>
                        <option value="القطيف">القطيف</option>
                        <option value="عنك">عنك</option>
                        <option value="الجبيل">الجبيل</option>
                        <option value="راس تنورة">راس تنورة</option>
                        <option value="الاحساء">الاحساء</option>
                    </select>
                </div>
                        <!-- Pay Type Select -->
                <div class="mb-3">
                    <label for="payType" class="form-label" >طريقة الدفع</label>
                    <select class="form-select" id="payType"  name="paytype" required>
                        <option value="كاش">كاش</option>
                        <option value="مكينة الشبكة">مكينة الشبكة</option>
                    </select>
                </div>
        
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">ارسال</button>
                </div>
      </div>
    </div>
  </div>
  
@push('myscripts')
@endpush
@endsection
