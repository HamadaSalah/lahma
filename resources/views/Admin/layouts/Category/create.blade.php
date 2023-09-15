@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">الاقسام الرئيسية</h4>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>اضافة قسم جديد</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{Route('admin.category.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="catname" class="form-label">اسم القسم</label>
                <input type="text" name="name" class="form-control" id="catname">
            </div>
            <div class="mb-3">
                <label for="catimg" class="form-label">الصورة</label>
                <input type="file" name="img" class="form-control" id="catimg" >
            </div>
            <div class="mb-3">
                <label for="catimg" class="form-label">قسم فرعي من ؟</label>
                <select class="form-select" name="category_id" aria-label="Default select example">
                    <option selected value="">قسم رئيسي</option>
                    @foreach ($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
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