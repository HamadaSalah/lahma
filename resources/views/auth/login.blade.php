@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5 mb-5">

                <div class="card-body">
                    <form method="POST" action="{{ route('mylogin') }}">
                        @csrf

                        <div class="row mb-3">
                            <center><h1 style="font-weight: bold" class="mb-3 mt-5">مرحباً</h1></center>
                            <label for="phone" class="col-md-12 col-form-label text-center mb-3">لكي تتمكن من الشراء قم بتسجيل الدخول</label>

                            <div class="col-md-12">
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary" style="margin: auto;display: block">
                                  تسجيل الدخول
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
