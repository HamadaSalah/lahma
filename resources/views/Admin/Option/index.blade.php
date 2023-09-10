@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">الاقسام الرئيسية</h4>
<a href="{{Route('admin.options.create')}}">
    <button class="btn btn-primary" style="">أضافة جديدة  <i class="fa-regular fa-square-plus addBtn"></i>  </button>
</a>
@endsection
@section('content')

<table class="table align-items-center justify-content-center mb-0" id="files_list3">
    <thead class="bg-gray-100">
        <tr>
            <th class="text-secondary text-xs font-weight-semibold opacity-7">اسم الاضافة</th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">الاضافات الداخلية</th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">اجراء</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($options as $option)
            <tr>
                <td>{{ $option->name}}</td>
                <td>
                    @foreach ($option->options as $item)
                        <span style="background: #ccc;border-radius: 5px;padding:3px 7px;margin-bottom: 10px;display: block">{{$item }}</span> 
                    @endforeach
                </td>
                <td>
                    <a href="{{Route('admin.options.edit', $option->id)}}"><button class="btn btn-success">تعديل</button></a>
                    <form style="display: inline;" action="{{route('admin.options.destroy', $option->id)}}" method="post">
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
            $('#files_list3').DataTable({
                "aLengthMenu": [
                    [5, 10, 25, -1],
                    [5, 10, 25, "All"]
                ],
                paging: false,
                searching: false,

                "iDisplayLength": 10,

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
