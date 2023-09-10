@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">المنتجات</h4>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>اضافة قسم جديد</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ Route('admin.products.store') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="catname" class="form-label">اسم المنتج</label>
                <input type="text" name="name" class="form-control" id="catname">
            </div>

            <div class="mb-3">
                <label for="catimg" class="form-label">الصورة</label>
                <input type="file" name="img" class="form-control" id="catimg">
            </div>

            <div class="mb-3">
                <label for="catimg" class="form-label">القسم ؟</label>
                <select class="form-select" name="category_id" aria-label="Default select example">
                    <option value="">اختر القسم</option>
                    @foreach($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="catimg" class="form-label">هل يوجد منتجات داخلية ؟</label>
                <select class="form-select" name="pro_type" aria-label="Default select example" id="IFPriceOrNot">
                    <option selected value="yes">نعم</option>
                    <option selected value="no">لا</option>
                </select>
            </div>

            <div class="mb-3" id="inputFields">
                <button type="button" class="btn btn-primary" onclick="addInputFields()">أضافة منتج داخلي</button>
                <br />

            </div>

            <div class="mb-3" id="PriceTab">
                <label for="catname" class="form-label"> سعر المنتج بالريال</label>
                <input type="number" name="price" class="form-control" id="catname">
            </div>

            <div class="mb-3">
                <label for="catname" class="form-label">تفاصيل المنتج</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="catname" class="form-label">الاضافات</label>
                <!-- Multi-Select Dropdown -->
                <div class="mb-3">
                    <select class="selectpicker" multiple name="options[]">
                        @foreach ($options as $op)
                        <option value="{{$op->id}}">{{$op->name}}</option>
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
