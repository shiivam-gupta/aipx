@extends ('backend.layouts.app')

@section ('title', 'Login')

@section('content')
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                            Session::forget('success');
                            @endphp
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card-title text-center">
                        Login Form
                        {{-- <div class="p-1"><img src="{{ asset('app-assets/images/logo/stack-logo-dark.png')}}" alt="branding logo"></div> --}}
                    </div>
                    {{-- <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Easily
                            Using</span></h6> --}}
                </div>
                <div class="card-content">
                    <div class="card-body pt-0">
                        <form class="form-horizontal" action="{{ route('login') }}" method="POST">
                            @csrf
                            <fieldset class="form-group floating-label-form-group">
                                <label for="user-name">Your Email</label>
                                <input type="email" name="email" class="form-control" id="user-name" placeholder="Your Username">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif

                            </fieldset>
                            <fieldset class="form-group floating-label-form-group mb-1">
                                <label for="user-password">Enter Password</label>
                                <input type="password" name="password" class="form-control" id="user-password" placeholder="Enter Password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-6 col-12 text-center text-sm-left">
                                    <fieldset>
                                        <input type="checkbox" name="remember" id="remember-me" class="chk-remember">
                                        <label for="remember-me"> Remember Me</label>
                                    </fieldset>
                                </div>
                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-block"><i class="feather icon-unlock"></i> Login</button>
                        </form>
                    </div>
                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>New to
                            Stack ?</span></p>
                    <div class="card-body">
                        <a href="{{ route('register') }}" class="btn btn-outline-danger btn-block"><i class="feather icon-user"></i> Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
@endsection