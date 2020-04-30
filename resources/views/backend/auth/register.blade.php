@extends ('backend.layouts.app')

@section ('title', 'Registration')

@section('content')
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="card-header border-0 pb-0">
                    {{-- <div class="card-title text-center">
                        <img src="{{ asset('app-assets/images/logo/stack-logo-dark.png" alt="branding logo') }}">
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Easily
                            Using</span></h6> --}}
                    <div class="card-title text-center">
                        SignUp Form
                    </div>
                </div>
                <div class="card-content">

                    <div class="card-body pt-0">
                        <form class="form-horizontal" action="{{ route('register.step1') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <fieldset class="form-group floating-label-form-group">
                                <label for="user-email">Email address</label>
                                <input type="email" name="email" class="form-control" id="user-email" placeholder="Enter Your Email Address" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group mb-1">
                                <label for="user-password">Password</label>
                                <input type="password" name="password" class="form-control" id="user-password" placeholder="Enter Your Password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group mb-1">
                                <label for="user-password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="user-password" placeholder="Enter Your Confirm Password">
                                @if ($errors->has('confirm_password'))
                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </fieldset>
                            @php 
                            $length =  6;
                            $randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length); @endphp
                            <fieldset class="form-group floating-label-form-group mb-1">
                                <label for="user-password">{{ $randomletter }}</label>
                                <input type="hidden" class="form-control" name="confirm_captcha" id="user-password" value="{{ $randomletter }}">
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group mb-1">
                                <label for="user-password">Confirm Captcha</label>
                                <input type="text" class="form-control" name="captcha" id="user-captcha" placeholder="Enter Your Captcha">
                                @if ($errors->has('captcha'))
                                    <span class="text-danger">{{ $errors->first('captcha') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group mb-1">
                                <div class="row">
                                    <div class="col-md-1">
                                    <input type="checkbox" name="aggrement" id="remember-me" class="chk-remember">
                                    </div>
                                    <div class="col-md-11">
                                        <label for="remember-me">By clicking Signup, you agree to the <a href="#">Terms, Data processor agreement</a> and have read and acknowledge our <a href="#">Privacy Statement</a></label>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                         @if ($errors->has('aggrement'))
                                            <span class="text-danger">{{ $errors->first('aggrement') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-outline-primary btn-block"><i class="feather icon-user"></i> Sign Up</button>
                        </form>
                    </div>
                    <!-- <div class="card-body pt-0">
                        <a href="{{ route('login') }}" class="btn btn-outline-danger btn-block"><i class="feather icon-unlock"></i> Login</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
@endsection