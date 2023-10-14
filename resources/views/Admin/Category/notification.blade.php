@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">الاقسام الرئيسية</h4>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>ارسال اشعارات الي تطبيق الموبايل</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{Route('admin.notification')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="catname" class="form-label">العنوان</label>
                <input type="text" name="head" class="form-control" id="catname">
            </div>
            <div class="mb-3">
                <label for="catname" class="form-label">التفاصيل</label>
                <input type="text" name="body" class="form-control" id="catname">
            </div>
            <button type="submit" class="btn btn-primary">حفط</button>
        </form>

    </div>
</div>

@endsection
@section('title')
الصفحة الرئيسية
@endsection
