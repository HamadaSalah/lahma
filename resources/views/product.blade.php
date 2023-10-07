@extends('layouts.app')
@section('content')
<div class="slider productSlider">
    <div class="container">
        <div class="row">
            <div class="intro">
                <h1>{{$product->name}} 
                </h1>
            </div>
            <div class="search">
                <img src="img/slider1.png" alt="" class="flightImg">
            </div>
        </div>
    </div>
</div>
<!-- This is Begin for details -->
<div class="pro_dd mt-5 mb-5 ">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('uploads/'.$product->img) }}"
                    style="width: 100%;margin: auto;display: block;text-align: center;border-radius: 5px"
                    class="img-responsive" alt="">
            </div>
            <div class="col-md-8">
                <div class="pro_name">
                    <h3>{{$product->name}} </h3>
                    <span>التصنيف - {{ $product->category->name }}</span>
                    <span class="mypprice">
                        @if ($product->price)
                            {{$product->price. ' ر.س ' }}
                        @endif
                        </span>
                </div>
                <div class="pro_tit">
                    <p>
                        {!! $product->description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ROute('addToCard')}}" method="POST">

@csrf
<input type="hidden" name="product_id" value="{{$product->id}}">
<input type="hidden" name="product_name" value="{{$product->name}}">
<input type="hidden" name="product_img" value="{{$product->img}}">
    <div class="pro_adds">
        <div class="container">
            {{-- SUbproductsRow --}}
            @if (count($product->products))
                <div class="row">
                    <h2>الحجم <span style="position: relative;bottom: -11px">*</span></h2>
                    @foreach($product->products as $subproducts)
                        <div class="col-lg-6 col-md-12">
                            <div class="Price">
                                <div>
                                    <div class="NameandSelect">
                                        <div class='py'>
                                            <label>
                                                <input type="radio" value="{{$subproducts->id}}" class="option-input radio SelectSUb" name="subProduct" required >
                                                <input type="hidden" value="{{$subproducts->price}}" class="option-input radio SelectSUb" name="price" required >
                                            </label>
                                        </div>
                                        <h5 style="padding-right: 20px;">{{$subproducts->name}}</h5>
                                    </div>
                                    <span>{{$subproducts->description}} </span>
                                </div>
                                <div>
                                    <h5 style="color: crimson;line-height: 50px;"> <input type="number" disabled value="{{$subproducts->price}}" class="disinput MyPrice"> ر.س</h5>
                                </div>
                                <div>
                                    <div class="number-input">
                                        <button class="minus" type="button">-</button>

                                        <input type="number" class="InMuber option-input radio" value="1" min="1" max="100"
                                            step="1" name="count" disabled>
                                        <button class="plus"  type="button">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    @endforeach

                </div>
            @endif
        </div>
    </div>
    <div class="pro_details">
        <div class="container">
            <div class="row">
                {{-- begin of features --}}
                @foreach ($product->options as $option)
                    <div class="parent_ext">
                        <h2>{{$option->name}} <span style="position: relative;bottom: -11px">*</span></h2>
                        <div class="row">
                            @foreach ( $option->options as $key => $op)
                                <div class="col-lg-6 col-md-12">
                                    <div class="extenstion">
                                        <h5>{{$op}}</h5>
                                        <div class="py">
                                            <label>
                                                <input type="radio" class="option-input radio" value="{{$op}}" name="options[{{$option->name}}]" required>
                                            </label>
                                        </div>
                                    </div>
                                </div>    
                            @endforeach
                        </div>
                    </div>                
                @endforeach
            </div>
        </div>
    </div>
    <div class="tootal">
        <div class="container">
            <div class="row">
                @if ($product->price)
                    <div class="text-center">
                        <div class="Price">
                            <div>
                                <div class="NameandSelect">
                                     <h5 style="padding-right: 20px;">{{$product->name}}</h5>
                                </div>
                             </div>
                            <div>
                                <h5 style="color: crimson;line-height: 50px;" class=""> <input type="number" disabled value="{{$product->price}}" class="disinput MyPrice ">  ر.س </h5>
                            </div>
                            <div>
                                <div class="number-input">
                                    <button class="minus" type="button">-</button>

                                    <input type="number" class="InMuber option-input radio" value="1" min="1" max="100"
                                        step="1" name="count">
                                    <button class="plus"  type="button">+</button>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
                <h5>المبلغ الإجمالي</h5>
                <h6 style="font-size: 30px"><input type="number" id="totalPrice" disabled style="background: transparent;border: 0;width: 70px;text-align: center;font-weight: bold" value="{{$product->price ?? 0}}"></span> ر.س</h6>
                <button class="btn btn-success" type="submit">إضافة للسلة</button>
                
                <span>ملاحظة: السعر شامل الذبح والتقطيع والتغليف والتوصيل وغير شامل الضريبة</span>
            </div>
        </div>
    </div>
</form>
    <!-- This is end for details -->
    @if ($product->price)
        @push('myscripts')
            <script>
                $(document).ready(function(){
                    $(".number-input button").attr("disabled", false);
                });
            </script>
        @endpush
@endif
@push('styles')
    <style>
        .plus, .minus{
            width: 30px!important
        }
    </style>
@endpush
@endsection
