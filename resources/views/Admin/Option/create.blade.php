@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">الاضافات</h4>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>اضافة جديدة</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{Route('admin.options.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="catname" class="form-label">اسم الاضافة</label>
                <input type="text" name="name" class="form-control" id="catname">
            </div>
            <div id="input-container">
                <button id="add-input" class="btn btn-primary" type="button"> <i class="fa-solid fa-plus"></i> اضافة خيار</button>
                
            </div>
        
            <button type="submit" class="btn btn-primary">حفط</button>
        </form>

    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        // Counter to keep track of input fields
        let counter = 0;

        // Function to add a new input field
        function addInput() {
            counter++;
            const inputField = `
                                <div class="mb-3 newselectss">
                                    <div class="input-field">
                                    <input class="form-control" type="text" name="options[]" id="option_${counter}" placeholder="خيار ${counter}">
                                    <button class="remove-input btn btn-danger">Remove</button>
                                    </div>
                                 </div>`;
            $("#input-container").append(inputField);

            // Attach a click event to the remove button
            $(`#option_${counter}`).siblings(".remove-input").on("click", function() {
                $(this).parent().parent().remove();
            });
        }

        // Attach click event to the "Add Input" button
        $("#add-input").on("click", function() {
            addInput();
        });
    });
</script>

@endpush
@endsection
@section('title')
الصفحة الرئيسية
@endsection
