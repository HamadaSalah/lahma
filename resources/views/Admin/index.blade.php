@extends('Admin.master')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6" style="padding-top: 20px">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon green">
                <i class="nc-icon nc-layers-3"></i>
            </div>
            <p class="card-category" style="font-weight:bold"> عدد الاقسام</p>
            <h3 class="card-title">{{$category}}
            </h3>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6" style="padding-top: 20px">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon yellow">
                <i class="nc-icon nc-grid-45"></i>
            </div>
            <p class="card-category" style="font-weight:bold"> عدد المنتجات</p>
            <h3 class="card-title">{{$product}}
            </h3>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6" style="padding-top: 20px">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon cayan">
                <i class="nc-icon nc-app"></i>
            </div>
            <p class="card-category" style="font-weight:bold"> عدد المستخدمين</p>
            <h3 class="card-title">{{$user}}
            </h3>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
   
      

</div>
@endsection
@section('title')
    الصفحة الرئيسية
@endsection