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
                    <a href="{{ Route('product', $prod->id) }}">
                    <div class="primary_product">
                        <img src="{{asset('uploads/'.$prod->img)}}" alt="">
                        <div class="pro_d">
                            <p>{{$prod->name}}</p>
                            <span></span>
                            <p>{{$prod->price ?? $prod->products[0]->price ?? ''}} ريال</p>
                            <a href="{{ Route('product', $prod->id) }}">
                                <button data-bs-toggle="tooltip" data-bs-placement="top" title="اطلب المنتج"><i
                                        class="addToCard fa-solid fa-plus"></i></button></a>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>
@push('myscripts')
    <script type="text/javascript">
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    </script>
@endpush

@endsection
