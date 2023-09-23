@extends('layouts.app')

@section('content')
<div class="slider sliderProducts">
    <div class="container">
        <div class="row">
            <div class="intro">
                <h1 style="text-align: center;">{{$name}}
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="products">
    <div class="container">
        <div class="row">
            @foreach ($products as $prod)
                
                <div class="col-md-4">
                    <div class="primary_product">
                        <img src="{{asset('uploads/'.$prod->img)}}" alt="">
                        <div class="pro_d">
                            <p>{{$prod->name}}</p>
                            <span></span>
                            <p>{{$prod->price ?? $prod->products[0]->price ?? ''}} ريال</p>
                            <a href="{{route('product', $prod->id)}}"><i class="addToCard fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
