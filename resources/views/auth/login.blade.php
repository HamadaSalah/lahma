@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5 mb-5">

                <div class="card-body">
                    <form method="POST" action="{{ route('mylogin') }}" id="MyRegFormm">
                        @csrf
                        <div class="row mb-3">
                            <center><h1 style="font-weight: bold" class="mb-3 mt-5">مرحباً</h1></center>
                            <label for="phone" class="col-md-12 col-form-label text-center mb-3">لكي تتمكن من الشراء قم بتسجيل الدخول</label>

                            <div class="col-md-12">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus  style="width: 70%;display: inline;text-align: left" >
                                <input type="text" class="form-control" style="width: 20%;display: inline;" disabled value="+966">
                                {{-- <div id="recaptcha-container"></div> --}}

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 ">
                                <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();" style="margin: auto;display: block">
                                  تسجيل الدخول
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="mb-5 mt-5" style="text-align: center;margin: auto" id="SeconddFrom">
                        <h3>برجاء كتابة كود التفعيل</h3>
                        <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
                        <div class="alert alert-danger" id="error" style="display: none;"></div>
                         <form>
                            <input type="text" id="verification" class="form-control" placeholder="كود التفيعل">
                            <button type="button" class="btn btn-danger mt-3" onclick="verify()">تفعيل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('myscripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<script>
    
    var firebaseConfig = {
        apiKey: "AIzaSyDJjaSlkj7waT8ErUfG6uWeaeABV8207d8",
        authDomain: "golden-bad09.firebaseapp.com",
        projectId: "golden-bad09",
        storageBucket: "golden-bad09.appspot.com",
        messagingSenderId: "384766955408",
        appId: "1:384766955408:web:ca59b2c6514890b0872d15",
        measurementId: "G-GCZXGHZRN5"
        
    };

    firebase.initializeApp(firebaseConfig);
</script>
<script type="text/javascript">
     var randomNumber = '';
    window.onload = function () {
        render();
    };

    
    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }


    function sendOTP() {
        $("#SeconddFrom").css({"display":"block"});
        $("#MyRegFormm").css({"display":"none"});
        var number = '966'+$("#phone").val();

        randomNumber = Math.floor(Math.random() * (999999 - 100000 + 1)) + 100000;
        console.log(randomNumber);
        $.ajax({
           type:'POST',
           url: '{{Route('sms')}}',
           data:{phone:number, code: randomNumber},
           success:function(data){
               
           }
        });

    }


    function verify() {
        var code = $("#verification").val();
        console.log(code);
        if(randomNumber == code) {
            document.getElementById('MyRegFormm').submit();

        }
        else {
            $("#error").text("كود التفعيل خاطئ");
                $("#error").show();

        }

        // var code = $("#verification").val();
        // coderesult.confirm(code).then(function (result) {
        //     var user = result.user;
        //     console.log(user);
        //     $("#successOtpAuth").text("كود التفعيل صحيح");
        //     $("#successOtpAuth").show();
            
        //     document.getElementById('MyRegFormm').submit();

        // }).catch(function (error) {
        //     $("#error").text("كود التفعيل خاطئ");
        //     $("#error").show();
        // });
    }
</script>

@endpush

@endsection
