@extends('layouts.app')

@section('content')
<div class="slider">
<div class="container">
    <div class="row">
        <div class="intro">
            <h1>أجود انواع اللحم
                <br />
                تلاقية عندنا
            </h1>
            <button class="btn btn-success">تصفح</button>
        </div>
        <div class="search">
            <img src="img/slider1.png" alt="" class="flightImg">
            <div class="searchdiv">
                <input type="text" placeholder="ابحث عـــــن المنــتــجات">
                <i class="searchiconn fa-solid fa-magnifying-glass"></i>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"> 
        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
        </svg> -->
            </div>
        </div>
    </div>
</div>
</div>
<div class="products">
<div class="container">
    <h1>المنــتــجات</h1>
    <div class="row">
        <!-- //firstnav   -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach($cats as $mycat)
                    <div class="col-lg-2 col-md-1 col-sm-6 nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="nav-{{$mycat->id}}-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-{{$mycat->id}}" type="button" role="tab" aria-controls="nav-{{$mycat->id}}"
                        aria-selected="true">
                        <a style="margin: 10px;display: block;">
                            <div class="singlePro">
                                <img src="{{asset('uploads/'.$mycat->img)}}" alt="">
                                <p>{{$mycat->name}} </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
             @foreach($cats as $mycatt)
                <div class="tab-pane fade<?php $ress = ($loop->index == 0) ? 'show active' : ''; echo $ress;?>" id="nav-{{$mycatt->id}}" role="tabpanel" aria-labelledby="nav-{{$mycatt->id}}-tab">
                    @if($mycatt->child)
                        <nav class="mysecondNav">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach ($mycatt->child as $child)
                                    <button class="nav-link mylinnkss <?php $ress = ($loop->index == 0) ? 'active' : ''; echo $ress;  ?>" id="nav-{{$child->id}}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{$child->id}}"
                                        type="button" role="tab" aria-controls="nav-{{$child->id}}" aria-selected="true">{{$child->name}}</button>
                                @endforeach
                            </div>
                        </nav>       
                        <div class="tab-content" id="nav-tabContent">
                            @if($mycatt->child)
                            @foreach ($mycatt->child as $mychild)
                                <div class="tab-pane fade show <?php $ress = ($loop->index == 0) ? 'active' : ''; echo $ress;  ?>" id="nav-{{$mychild->id}}" role="tabpanel" aria-labelledby="nav-{{$mychild->id}}-tab">
                                    <div class="row">
                                        @foreach ($mychild->products as $prodd)
                                            <div class="col-md-4">
                                                <div class="primary_product">
                                                    <img src="{{asset('uploads/'.$prodd->img)}}" alt="">
                                                    <div class="pro_d">
                                                        <p>{{$prodd->name}}</p>
                                                        <span>{{$prodd->name}}</span>
                                                        <p>{{$prodd->price ?? $prodd->products[0]->price ?? ''}} ريال</p>
                                                        <a href="{{Route('product', $prodd->id)}}"><i class="addToCard fa-solid fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    @endif
                                        {{-- //if Has any product Directly --}}
                                        <div class="row">
                                            @foreach ($mycatt->products as $prodd2)
                                                <div class="col-md-4">
                                                    <div class="primary_product">
                                                        <img src="{{asset('uploads/'.$prodd2->img)}}" alt="">
                                                        <div class="pro_d">
                                                            <p>{{$prodd2->name}}</p>
                                                            <span>{{$prodd2->name}}</span>
                                                            <p>{{$prodd2->price ?? $prodd2->products[0]->price ?? ''}} ريال</p>
                                                            <a href="{{Route('product', $prodd2->id)}}"><i class="addToCard fa-solid fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            @endforeach
                                        </div>
                    
                                        {{-- //endif Has any product Directly --}}
                    
                </div>
            @endforeach


        </div>
    </div>
</div>
</div>
<div class="mazaya">
<div class="container">
    <div class="row">
        <h1 class="divHead">مزايا أضافية لراحتك</h1>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
            <div class="maz">
                <img src="img/maz/1.png" alt="">
                <p>الجودة</p>
                <span>نهتم بجودة اللحوم ونظافتها باستمرار</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
            <div class="maz">
                <img src="img/maz/2.png" alt="">
                <p>التغليف</p>
                <span>نهتم بجودة اللحوم ونظافتها باستمرار</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
            <div class="maz">
                <img src="img/maz/3.png" alt="">
                <p>دفع اسهل</p>
                <span>نهتم بجودة اللحوم ونظافتها باستمرار</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
            <div class="maz">
                <img src="img/maz/4.png" alt="">
                <p>توصيل اسرع</p>
                <span>نهتم بجودة اللحوم ونظافتها باستمرار</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
            <div class="maz">
                <img src="img/maz/5.png" alt="">
                <p>عملية الذبح</p>
                <span>نهتم بجودة اللحوم ونظافتها باستمرار</span>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
            <div class="maz">
                <img src="img/maz/5.png" alt="">
                <p>التقطيع</p>
                <span>نهتم بجودة اللحوم ونظافتها باستمرار</span>
            </div>
        </div>
    </div>
</div>
</div>
<div class="most_order">
<div class="container">
    <div class="row">
        <h1 class="divHead">الأكثر طلباً</h1>
        @foreach ($products as $prod)
            <div class="col-md-4">
                <div class="primary_product">
                    <img src="{{asset('uploads/'.$prod->img)}}" alt="">
                    <div class="pro_d">
                        <p>{{$prod->name}}</p>
                        {{-- <span>8 - 11 كيلو</span> --}}
                        <p>{{$prod->price ?? $prod->products[0]->price ?? ''}} ريال</p>
                        <a href="{{Route('product', $prod->id)}}"><i class="addToCard fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
            
        @endforeach
            <div class="text-center">
                <a href="{{Route('products')}}"><button class="btn btn-primary mt-5">المزيد</button></a>
            </div>
    </div>
</div>
</div>
<div class="testmon">
<div class="container">
    <div class="row">
        <h1 class="divHead">آراء العملاء</h1>
        <div class="col-md-12">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="userss">
                            <h1>سارة القحطاني</h1>
                            <p>لحوم مرررة لذيذة والأهم النظاااافة<br />
                                في الذبائح شكررررا لكم</p>
                        </div>

                    </div>
                    <div class="carousel-item">
                        <div class="userss">
                            <h1>سارة القحطاني</h1>
                            <p>لحوم مرررة لذيذة والأهم النظاااافة<br />
                                في الذبائح شكررررا لكم</p>
                        </div>

                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
