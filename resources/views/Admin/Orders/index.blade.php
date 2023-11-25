@extends('Admin.master')
@section('title')

<h4 class="text-white px-3" style="float: right">كل الطلبات</h4>
@endsection
@section('content')

<table class="table align-items-center justify-content-center mb-0" id="files_list2">
    <thead class="bg-gray-100">
        <tr>
            <th class="text-secondary text-xs font-weight-semibold opacity-7">الهاتف</th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">الطلبات</th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">التفاصيل</th>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">التاريخ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->user->phone}}</td>
                <td>
                    @foreach ($order->products as $prod)
                        <li>{{$prod->product?->name}} -  العدد <span class="myco">{{$prod->count}}</span></li>
                    @endforeach
                </td>
                <td><button class="btn btn-success ShowDet" data-bs-toggle="modal" data-bs-target="#orderdetails" data-id="{{$order->id}}" >اظهار التفاصيل</button></td>
                <td>
                    {{$order->created_at->diffForHumans()}}<br/>
                    {{ $order->created_at}}
                
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
                "order": [],
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
  <!-- Modal -->
  <div class="modal fade" id="orderdetails" tabindex="-1" aria-labelledby="orderdetailsLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">تفاصيل الطلب</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="Mydata">

          <div id="number" class="mb-1">

          </div>

          <div id="product-container">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
        </div>
      </div>
    </div>
  </div>
  
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        // Click event handler for the button
        $(".ShowDet").click(function () {
            // Get the data-id attribute from the button
            var id = $(this).data("id");
    
            // Send an AJAX request to your API
            $.ajax({
                url: "/api/order/" + id,
                method: "GET",
                success: function (data) {
                    $("#number").text("");

                    $("#opt").html("");

                    $("#productt").html("");
                    $(".productView").hide();
 
                    // Handle the successful response
                    // Assuming the API returns a JSON object
                    // You can update this part to format and display the data as needed
                    var modalData = JSON.stringify(data, null, 2);

                    const productContainer = document.getElementById("product-container");
                    const PhoneContainer = document.getElementById("number");

                    PhoneContainer.innerHTML  = `رقم الهاتف: ${data.user.phone}
                    <br>
                    الاسم: ${data.name}
                    <br> 
                    العنوان: ${data.address}
                    <br> 
                    المدينة: ${data.city}
                    <br>
                    الدفع: ${data.paytype}
                    `;


                    data.products.forEach((product) => {
                        const productDiv = document.createElement("div");
                        productDiv.classList.add("productView");

                        const productNameDiv = document.createElement("div");
                        productNameDiv.textContent = `${product.product.name}`;
                        
                        const productCountDiv = document.createElement("div");
                        productCountDiv.textContent = `العدد : ${product.count}`;

                        const optionsDiv = document.createElement("div");
                        
                        if (typeof product.options === 'object' && product.options !== null && Object.keys(product.options).length ) {
                            console.log(Object.keys(product.options).length);
                            const optionsTitleDiv = document.createElement("div");
                            optionsTitleDiv.textContent = "الاضافات:";
                            
                            optionsDiv.appendChild(optionsTitleDiv);

                            Object.keys(product.options).forEach((optionKey) => {
                                const optionValue = product.options[optionKey];
                                const optionDiv = document.createElement("div");
                                optionDiv.textContent = `${optionKey}: ${optionValue}`;
                                optionsDiv.appendChild(optionDiv);
                            });
                        } else {
                            optionsDiv.textContent = ``;
                        }

                        productDiv.appendChild(productNameDiv);
                        productDiv.appendChild(productCountDiv);
                        productDiv.appendChild(optionsDiv);

                        productContainer.appendChild(productDiv);
                    });

                    // Display the modal with the retrieved data
                    // $("#number").text("رقم الهاتف : " + data.user.phone);
                    // $.each(data.products, function(index, val) {
                    //     $("#productt").append(`<li>${val.product.name} - العدد : ${val.count}</li>`);
                    //     if(val.options) {
                    //         $.each(val.options, function(index1, val1) {
                    //             $("#opt").append(`<li>${index1} -  ${val1}</li>`);
    
                    //         });

                    //     }
                    // });
                    // $("#subs").text(modalData);
                    // $("#opt").text(modalData);
                    // $("#orderdetails").css("display", "block");
                },
                error: function () {
                    // Handle errors here
                    alert("An error occurred while fetching data.");
                }
            });
        });
    
        // Close the modal when the close button is clicked
        $(".close").click(function () {
            $("#orderdetails").css("display", "none");
        });
    });

</script>

@endpush



 