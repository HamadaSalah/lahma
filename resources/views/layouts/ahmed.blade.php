@extends('layouts.master')
@section('title')
Products
@stop
    @section('css')
    <!-- Internal Data table css -->
    <link
        href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link
        href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" />
    <link
        href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}"
        rel="stylesheet">
    @endsection
    @section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Products</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
    @endsection
    @section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- row -->

    <div class="row">
        @if(session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session()->has('Error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session()->has('Edit'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Edit') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session()->has('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('delete') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">Add product</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">product_name</th>
                                    <th class="border-bottom-0">section_name</th>
                                    <th class="border-bottom-0">description</th>
                                    <th class="border-bottom-0">processes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0?>
                                @foreach($products as $y)
                                    <?php $i++?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $y->Product_name }}</td>
                                        <td>{{ $y->section->section_name }}</td>
                                        <td>{{ $y->description }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $y->id }}" data-name="{{ $y->Product_name }}"
                                                data-section_name="{{ $y->section->section_name }}"
                                                data-description="{{ $y->description }}" data-toggle="modal"
                                                href="#exampleModal2" title="Edite"><i class="las la-pen"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $y->id }}" data-product_name="{{ $y->product_name }}"
                                                data-toggle="modal" href="#DeleteingModel" title="Delete"><i
                                                    class="las la-trash"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Add product</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" autocomplete="off">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">product name</label>
                                <input type="text" class="form-control" id="Product_name" name="Product_name">
                            </div>
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">section</label>
                            <select name="section_id" id="section_id" class="form-control">
                                <option value="" selected desable>--select section--</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="Products/update" method="post" autocomplete="off">
                            {{ method_field('patch') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">id</label>
                                <input type="text" class="form-control" id="id" name="id">
                                <label for="exampleInputEmail1">product name</label>
                                <input type="text" class="form-control" id="Product_name" name="Product_name">
                            </div>
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">section</label>
                            <select name="section_id" id="section_id" class="form-control">
                                <option value="" selected desable>--select section--</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Edit Data</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- delete -->
            <!-- <div class="modal" id="modaldemo9">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="products/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>Do you sure exit processes </p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            <button type="submit" class="btn btn-danger">Sure </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
           

        </div>
        <div class="modal fade" id="DeleteingModel" tabindex="-1" role="dialog" aria-labelledby="DeleteingModelLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteingModelLabel">Edit product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="products/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>Do you sure exit processes </p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
                            <button type="submit" class="btn btn-danger">Sure </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    @endsection
    @section('js')
    <!-- Internal Data tables -->
    <script
        src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}">
    </script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}">
    </script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>


    <script>
        $('#exampleModal2').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var Product_name = button.data('name')
            var section_name = button.data('section_name')
            var id = button.data('id')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #Product_name').val(Product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #id').val(id);
        })

        $('#modaldemo9').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name ')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
        })

    </script>


    @endsection
