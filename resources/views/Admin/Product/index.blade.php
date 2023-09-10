@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">كل المنتجات</h4>
<a href="{{Route('admin.products.create')}}">
    <button class="btn btn-primary" style="">أضافة منتج جديد  <i class="fa-regular fa-square-plus addBtn"></i>  </button>
</a>
@endsection
@section('content')

<table class="table align-items-center justify-content-center mb-0" id="files_list2">
    <thead class="bg-gray-100">
        <tr>
            <th class="text-secondary text-xs font-weight-semibold opacity-7">المنتج</th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">المنتجات الداخلية</th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">السعر</th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">الصورة</th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">اجراء</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name}}</td>
                <td style="font-size: 20px">
                    <a href="{{Route('admin.subproducts.show', $product->id)}}">
                        <i class="fa-solid fa-code-fork"></i>
                    </a>
                </td>
                <td>{{$product->price ? $product->price : 'السعر يشمل منتجات داخلية'}}</td>
                <td>
                    @if ($product->img)
                    <img src="{{ asset('uploads/'.$product->img) }}" style="width: 100px;border-radius: 5px" alt="xd"></td>
                        @else
                        لا يوجد
                    @endif
                <td>
                    <a href="{{Route('admin.products.edit', $product->id)}}"><button class="btn btn-success">تعديل</button></a>
                    <form style="display: inline;" action="{{route('admin.products.destroy', $product->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">حذف </button>
                    </form>
                </td>
            </tr>            
        @endforeach
        
    </tbody>
</table>
@push('scripts')
    <link href="{{ asset('dashboard/assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('dashboard/assets/js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#files_list2').DataTable({

                "language": {
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                }
            });
        });

    </script>

@endpush
@endsection
