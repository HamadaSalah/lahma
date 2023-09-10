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
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fa fa-close" class="myclose"></i>
    </button>
    <span>
        <b> Danger - </b> {{session('error')}}</span>
</div>
</div>
@endif
