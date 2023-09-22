@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">المنتجات</h4>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>تعديل المنتج</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ Route('admin.products.update', $product->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="catname" class="form-label">اسم المنتج</label>
                <input type="text" name="name" class="form-control" id="catname" value="{{ $product->name }}">
            </div>

            <div class="mb-3">
                <label for="catimg" class="form-label">الصورة</label>
                <input type="file" name="img" class="form-control" id="catimg">
            </div>

            <div class="mb-3">
                <label for="count" class="form-label">العدد</label>
                <input type="number" name="count" class="form-control" id="count" value="{{ $product->count }}">
            </div>

            <div class="mb-3">
                <label for="catimg" class="form-label">القسم ؟</label>
                <select class="form-select" name="category_id" aria-label="Default select example">
                    <option value="">اختر القسم</option>
                    @foreach($cats as $cat)
                        <option <?php if($cat->id == $product->category_id) echo "selected"; ?>
                            value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3" id="inputFields" style="<?php if(count($product->products) > 0) echo "display:block" ?>">
                <button type="button" class="btn btn-primary" onclick="addInputFields()">أضافة منتج داخلي</button>
                <br />
                @foreach ($product->products as $item)
                    <label class="form-label">الاسم</label><input type="text" name="names[]" value="{{$item->name}}" class="form-control"><label
                        class="form-label">السعر</label><input type="number" name="prices[]" value="{{$item->price}}"  class="form-control"><label
                        class="form-label">التفاصيل</label><input type="text" value="{{$item->description}}"  name="descriptions[]"
                        class="form-control"><br>
                    <hr>
                @endforeach
            </div>
            @if ( $product->price)
                <div class="mb-3" id="PriceTab">
                    <label for="catname" class="form-label"> سعر المنتج بالريال</label>
                    <input type="number" name="price" class="form-control" id="catname" value="{{ $product->price }}">
                </div> 
            @endif

            <div class="mb-3">
                <label for="catname" class="form-label">تفاصيل المنتج</label>
                <textarea name="description" class="form-control" style="">{!! $product->description !!}</textarea>
                <script>
                    CKEDITOR.replace('description');
                </script>

            </div>

            <div class="mb-3">
                <label for="catname" class="form-label">الاضافات</label>
                <!-- Multi-Select Dropdown -->
                <div class="mb-3">
                    <select class="selectpicker" multiple name="options[]">
                        @foreach($options as $op)
                            <option <?php if(in_array($op->id, $product->options->pluck('id')->toArray())) echo "selected"; ?> value="{{ $op->id }}">{{ $op->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" style="position: relative;z-index: 99999999;" class="btn btn-primary">حفط</button>
        </form>

    </div>
</div>
@push('styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

@endpush
@endsection
@section('title')
الصفحة الرئيسية
@endsection
@push('scripts')
    <script src="https://preview.colorlib.com/theme/bootstrap/multiselect-04/js/popper.js"></script>
    <script src="https://preview.colorlib.com/theme/bootstrap/multiselect-04/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        let inputCount = 0; // Counter to keep track of added inputs

        function addInputFields() {
            inputCount++; // Increment the counter

            // Create input fields dynamically
            const inputFieldsDiv = document.getElementById("inputFields");

            const nameLabel = document.createElement("label");
            nameLabel.innerHTML = "الاسم";
            nameLabel.classList.add("form-label"); // Add class to the label
            const nameInput = document.createElement("input");
            nameInput.type = "text";
            nameInput.name = "names[]";
            nameInput.classList.add("form-control"); // Add class to the input

            const priceLabel = document.createElement("label");
            priceLabel.innerHTML = "السعر";
            priceLabel.classList.add("form-label"); // Add class to the label
            const priceInput = document.createElement("input");
            priceInput.type = "number";
            priceInput.name = "prices[]";
            priceInput.classList.add("form-control"); // Add class to the input

            const descriptionLabel = document.createElement("label");
            descriptionLabel.innerHTML = "التفاصيل";
            descriptionLabel.classList.add("form-label"); // Add class to the label
            const descriptionInput = document.createElement("input");
            descriptionInput.type = "text";
            descriptionInput.name = "descriptions[]";
            descriptionInput.classList.add("form-control"); // Add class to the input

            // Append input fields to the div
            inputFieldsDiv.appendChild(nameLabel);
            inputFieldsDiv.appendChild(nameInput);
            inputFieldsDiv.appendChild(priceLabel);
            inputFieldsDiv.appendChild(priceInput);
            inputFieldsDiv.appendChild(descriptionLabel);
            inputFieldsDiv.appendChild(descriptionInput);
            inputFieldsDiv.appendChild(document.createElement("br"));
            inputFieldsDiv.appendChild(document.createElement("hr"));
        }

    </script>
    <script>
        $(document).ready(function () {
            $('.filter-option-inner-inner').html("Your text here");

            $('#IFPriceOrNot').on('input', function () {
                if ($(this).val() === 'yes') {
                    $('#inputFields').css({
                        "display": "block"
                    });
                    $('#PriceTab').css({
                        "display": "none"
                    });
                } else {
                    $('#inputFields').css({
                        "display": "none"
                    });
                    $('#PriceTab').css({
                        "display": "block"
                    });

                }
            });
        });

    </script>

@endpush
