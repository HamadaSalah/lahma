@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">المستخدمين</h4>
 @endsection
@section('content')

<table class="table align-items-center justify-content-center mb-0" id="files_list3">
    <thead class="bg-gray-100">
        <tr>
            <th class="text-secondary text-xs font-weight-semibold opacity-7">اسم </th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">الرقم</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name  ?? 'بدون اسم'}}</td>
                <td>{{ $user->phone}}</td>
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
                "order": [],
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
