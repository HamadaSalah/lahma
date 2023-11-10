@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">الاعدادات</h4>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>الاعدادات</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{Route('admin.settings.update', 1)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="catname" class="form-label">عنا</label>
                <textarea type="text" name="about_us" class="form-control" value="">{{$set->about_us}}</textarea>
            </div>
            <div class="mb-3">
                <label for="catname" class="form-label">العنوان</label>
                <input type="text" name="address" class="form-control" value="{{$set->address}}">
            </div>
            <div class="mb-3">
                <label for="catname" class="form-label">الرقم 1</label>
                <input type="text" name="phone1" class="form-control" value="{{$set->phone1}}">
            </div>
            <div class="mb-3">
                <label for="catname" class="form-label">الرقم 2</label>
                <input type="text" name="phone2" class="form-control" value="{{$set->phone2}}">
            </div>
            <div class="mb-3">
                <label for="catname" class="form-label">البريد</label>
                <input type="text" name="email" class="form-control" value="{{$set->email}}">
            </div>
            <div class="mb-3">
                <label for="catname" class="form-label">الحقوق</label>
                <textarea type="text" name="terms" class="form-control" value="">{{$set->terms}}</textarea>
            </div>
            <div class="mb-3">
                <label for="catname" class="form-label">فيديو انترو الموبايل</label>
                <input type="file" name="video" class="form-control" accept=".mp4">
            </div>
            <div class="mb-3">
                <label for="catname" class="form-label">حالة فيديو الموبايل</label>
                <select name="video_off" id="" class="form-control">
                    <option value="1">ظهور</option>
                    <option value="0">عدم ظهور</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">حفط</button>
        </form>

    </div>
</div>

@endsection
@section('title')
الصفحة الرئيسية
@endsection
