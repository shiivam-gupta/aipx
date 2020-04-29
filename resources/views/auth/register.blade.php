<!doctype html>
<html lang="en" dir="ltr">

<!-- NRTregister.html by NRT, Mon, 31 Dec 2018 06:30:03 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="msapplication-TileColor" content="#ff685c">
    <meta name="theme-color" content="#32cafe">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <!-- Title -->
    <title>NRT – Admin Bootstrap4 Responsive Webapp Dashboard Template</title>
    <link rel="stylesheet" href="{{asset('assets/fonts/fonts/font-awesome.min.css')}}">

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700" rel="stylesheet">

    <!-- Dashboard Css -->
    <link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet" />

    <!-- c3.js Charts Plugin -->
    <link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet" />

    <!-- Custom scroll bar css-->
    <link href="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!---Font icons-->
    <link href="{{asset('assets/plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />

</head>

<body class="login-img">
    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <form action="{{url('/patient-register')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="userType" value="3" />
                        @csrf
                        <div class="col mx-auto">
                            <div class="text-center mb-6">
                                <img src="assets/images/brand/logo.png" class="" alt="">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card-group mb-0">
                                        <div class="card p-4">
                                            <div class="card-body">
                                                <h1>Patient Register</h1>
                                                <p class="text-muted">Create New Account</p>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-user w-4"></i></span>
                                                    <input type="text" class="form-control" placeholder="Entername"
                                                        name="name" value="{{old('name')}}">
                                                </div>
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                                <div class="input-group mb-4">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-envelope  w-4"></i></span>
                                                    <input type="text" class="form-control" placeholder="Enter Email"
                                                        name="email" value="{{old('email')}}">

                                                </div>
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                                <div class="input-group mb-4">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-unlock-alt  w-4"></i></span>
                                                    <input type="password" class="form-control password"
                                                        placeholder="Password" name="password"
                                                        value="{{old('password')}}">

                                                </div>
                                                @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                                <div class="input-group mb-4">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-unlock-alt  w-4"></i></span>
                                                    <input type="password" class="form-control cpassword"
                                                        placeholder="Confirm Password" name="confirm_password"
                                                        value="{{old('confirm_password')}}">

                                                </div>
                                                @if ($errors->has('confirm_password'))
                                                <span
                                                    class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                                @endif
                                                <span class="text-danger cpasswordError"></span>
                                                <div class="input-group mb-4">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-phone-square  w-4"></i></span>
                                                    <input type="number" class="form-control" placeholder="Phone Code"
                                                        name="phone_code" value="{{old('phone_code')}}">
                                                </div>
                                                @if ($errors->has('phone_code'))
                                                <span class="text-danger">{{ $errors->first('phone_code') }}</span>
                                                @endif
                                                <div class="input-group mb-4">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-phone-square  w-4"></i></span>
                                                    <input type="number" class="form-control" placeholder="Phone Number"
                                                        name="phone_no" value="{{old('phone_no')}}">

                                                </div>
                                                @if ($errors->has('phone_no'))
                                                <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                                @endif
                                                <div class="input-group mb-4">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-credit-card-alt  w-4"></i></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Credit Card Number" name="credit_card_number"
                                                        value="{{old('credit_card_number')}}">

                                                </div>
                                                @if ($errors->has('credit_card_number'))
                                                <span
                                                    class="text-danger">{{ $errors->first('credit_card_number') }}</span>
                                                @endif
                                                <div class="input-group mb-4">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-credit-card-alt  w-4"></i></span>
                                                    <input type="text" class="form-control" id="datetimepicker10"
                                                        placeholder="Expiry Date exp 03/22" name="expiry_date"
                                                        value="{{old('expiry_date')}}">

                                                </div>
                                                @if ($errors->has('expiry_date'))
                                                <span class=" text-danger">{{ $errors->first('expiry_date') }}</span>
                                                @endif
                                                {{-- For add more Feilds --}}
                                                {{-- <div class="input-group mb-4">
                                                    <span class="input-group-addon"><i
                                                            class="fa fa-calendar  w-4"></i></span>
                                                    <input type="text" class="form-control" placeholder="Enter Dob"
                                                        name="dob" id="dobCalender" value="{{old('dob')}}">
                                            </div>
                                            @if ($errors->has('dob'))
                                            <span class=" text-danger">{{ $errors->first('dob') }}</span>
                                            @endif
                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-address-card-o  w-4"></i></span>
                                                <textarea rows="5" cols="40" class="form-control"
                                                    placeholder="Enter Address"
                                                    name="address">{{old('address')}}</textarea>

                                            </div>
                                            @if ($errors->has('address'))
                                            <span class=" text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-mars-stroke-h  w-4"></i></span>
                                                <select class="form-control" name="gender">
                                                    <option value="">--Select Gender--</option>
                                                    <option value="male" {{old('gender') == 'male' ? 'selected' :''}}>
                                                        Male</option>
                                                    <option value="female"
                                                        {{old('gender') == 'female' ? 'selected' :''}}>Female
                                                    </option>
                                                    <option value="others"
                                                        {{old('gender') == 'others' ? 'selected' :''}}>Others
                                                    </option>
                                                </select>

                                            </div>
                                            @if ($errors->has('gender'))
                                            <span class=" text-danger">{{ $errors->first('gender') }}</span>
                                            @endif

                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i class="fa fa-globe  w-4"></i></span>
                                                <input type="text" class="form-control" placeholder="Enter Religion"
                                                    name="religion" value="{{old('religion')}}">
                                            </div>
                                            @if ($errors->has('religion'))
                                            <span class=" text-danger">{{ $errors->first('religion') }}</span>
                                            @endif

                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i class="fa fa-globe w-4"
                                                        aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" placeholder="Enter Country"
                                                    name="country" value="{{old('country')}}">
                                            </div>
                                            @if ($errors->has('country'))
                                            <span class=" text-danger">{{ $errors->first('country') }}</span>
                                            @endif
                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i class="fa fa-globe  w-4"></i></span>
                                                <input type="text" class="form-control" placeholder="Enter State"
                                                    name="state" value="{{old('state')}}">
                                            </div>
                                            @if ($errors->has('state'))
                                            <span class=" text-danger">{{ $errors->first('state') }}</span>
                                            @endif

                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i class="fa fa-globe  w-4"></i></span>
                                                <input type="text" class="form-control" placeholder="Enter City"
                                                    name="city" value="{{old('city')}}">
                                            </div>
                                            @if ($errors->has('city'))
                                            <span class=" text-danger">{{ $errors->first('city') }}</span>
                                            @endif

                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i class="fa fa-user  w-4"></i></span>
                                                <select class="form-control" name="marital_status">
                                                    <option value="">--Select Marital Status--</option>
                                                    <option value="married"
                                                        {{old('marital_status') == 'married' ? 'selected' :''}}>
                                                        Maried</option>
                                                    <option value="single"
                                                        {{old('marital_status') == 'single' ? 'selected' :''}}>
                                                        Single</option>
                                                </select>

                                            </div>
                                            @if ($errors->has('marital_status'))
                                            <span class=" text-danger">{{ $errors->first('marital_status') }}</span>
                                            @endif

                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i class="fa fa-globe  w-4"></i></span>
                                                <input type="text" class="form-control" name="nationality"
                                                    value="{{old('nationality')}}">

                                            </div>
                                            @if ($errors->has('nationality'))
                                            <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                            @endif --}}
                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-picture-o  w-4"></i></span>
                                                <input type="file" class="form-control" name="profile_pic"
                                                    value="{{old('profile_pic')}}">

                                            </div>
                                            @if ($errors->has('profile_pic'))
                                            <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                                            @endif

                                            <div class="form-group">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" />
                                                    <span class="custom-control-label">Agree the <a
                                                            href="terms.html">terms and policy</a></span>
                                                </label>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="btn btn-gradient-primary btn-block px-4">create
                                                        a new
                                                        account</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card text-white bg-primary py-5 d-md-down-none login-transparent">
                                        <div class="card-body text-center">
                                            <div>
                                                <h2>Already have account?</h2>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                    sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna
                                                    aliqua. It
                                                    is a long established fact that a reader will be
                                                    distracted by
                                                    the readable content of a page when looking at its
                                                    layout. Many
                                                    desktop publishing packages and web page editors now use
                                                    Lorem
                                                    Ipsum as their default model text, and a search</p>
                                                <a href="/login-patient"
                                                    class="btn btn-gradient-success  active mt-3">Sign in
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    <!-- Dashboard js -->
    <script src="{{asset('assets/js/vendors/jquery-3.2.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="{{asset('assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/selectize.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/jquery.tablesorter.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/circle-progress.min.js')}}"></script>
    <script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>

    <!-- Custom scroll bar Js-->
    {{-- <script src="{{asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.Js')}}}"></script> --}}
    <script>
        $(function () {
        $('#datetimepicker10').datetimepicker({
        viewMode: 'years',
        format: 'MM/YY'
        });
        });

        $(function () {
        $('#dobCalender').datetimepicker({
        viewMode: 'years',
        format: 'DD/MM/YY'
        });
        });
       
       
    </script>
</body>

<!-- NRTregister.html by NRT, Mon, 31 Dec 2018 06:30:03 GMT -->

</html>