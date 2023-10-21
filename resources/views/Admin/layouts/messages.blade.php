@if ($errors->any())
<div class="row">
    @foreach ($errors->all() as $error)
        <li>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fa fa-close" class="myclose"></i>
                </button>
                <span>
                    <b> Danger - </b> {{$error}}</span>
            </div>
        </li>
    @endforeach
</div>
@endif

@if (session('success'))
<div class="row">
<div class="col-md-12">
    <div class="alert alert-success ">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fa fa-close"  class="myclose"></i>
        </button>
        <span>
        <b> Success - </b> {{session('success')}}</span>
    </div>
</div>
</div>
@endif
@if (session('error'))
<div class="row">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Danger - </b> {{session('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i style="color: #000;margin-top: 10px" class="fa-solid fa-xmark"></i></button>
    </div>
{{-- <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fa fa-close" class="myclose"></i>
    </button>
    <span>
        <b> Danger - </b> {{session('error')}}</span>
</div> --}}
</div>
@endif
