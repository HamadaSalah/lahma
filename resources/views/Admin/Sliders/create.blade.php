@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">اضافة السلايدرز</h4>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>اضافة سلايدر جديد</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{Route('admin.sliders.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="catimg" class="form-label">الصورة</label>
                <input type="file" name="img" class="form-control" id="catimg" >
            </div>
            <button type="submit" class="btn btn-primary">حفط</button>
        </form>

    </div>
</div>

@endsection
@section('title')
الصفحة الرئيسية
@endsection
