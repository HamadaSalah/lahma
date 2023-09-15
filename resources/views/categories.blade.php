@extends('layouts.app')

@section('content')
<div class="slider sliderProducts">
    <div class="container">
      <div class="row">
        <div class="intro">
          <h1 style="text-align: center;">الاصـــــنـــــــــــــاف
          </h1>
        </div>
      </div>
    </div>
  </div>
<div class="products">
    <div class="container">
        <div class="row">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach($cats as $mycat)
                        <div class="col-lg-2 col-md-3 col-sm-6 col-4 nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="nav-{{$mycat->id}}-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-{{$mycat->id}}" type="button" role="tab" aria-controls="nav-{{$mycat->id}}"
                            aria-selected="true">
                            <a>
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
                    <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}" id="nav-{{$mycatt->id}}" role="tabpanel" aria-labelledby="nav-{{$mycatt->id}}-tab">
                        @if($mycatt->child)
                            <nav class="mysecondNav">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach ($mycatt->child as $child)
                                        <button class="nav-link active" id="nav-{{$child->id}}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{$child->id}}"
                                            type="button" role="tab" aria-controls="nav-{{$child->id}}" aria-selected="true">{{$child->name}}</button>
                                    @endforeach
                                </div>
                            </nav>       
                        @endif
                        <div class="tab-content" id="nav-tabContent">
                            @if($mycatt->child)
                            @foreach ($mycatt->child as $mychild)
                                <div class="tab-pane fade show active" id="nav-{{$mychild->id}}" role="tabpanel" aria-labelledby="nav-{{$mychild->id}}-tab">
                                    <div class="row">
                                        @foreach ($mychild->products as $prodd)
                                            <div class="col-md-4">
                                                <div class="primary_product">
                                                    <img src="{{asset('uploads/'.$prodd->img)}}" alt="">
                                                    <div class="pro_d">
                                                        <p>{{$prodd->name}}</p>
                                                        <span>{{$prodd->name}}</span>
                                                        <p>{{$prodd->price}} ريال</p>
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
 
@endsection
