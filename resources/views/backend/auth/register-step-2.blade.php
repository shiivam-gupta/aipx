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
                </div>
                <div class="card-content">
                    <div class="card-body text-center">
                        <h4>Register Step 2</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form class="form-horizontal" action="{{ route('register.step2') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="userId" value="{{ $userId }}">
                            <fieldset class="form-group floating-label-form-group">
                                <label for="user-name">Full name</label>
                                <input type="text" name="name" class="form-control" id="user-name" placeholder="Enter Your Full Name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="user-code">Country Code</label>
                                        <select class="form-control" id="user-code" name="country_code">
                                            @foreach($country_code as $key => $value)
                                                <option value="{{ $value->code }}" {{ $value->code == old('country_code') ? 'selected' : ''}}>{{ $value->code }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country_code'))
                                            <span class="text-danger">{{ $errors->first('country_code') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <label for="user-phone">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" id="user-phone" placeholder="Enter Your Number" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Enter Your Company Name" value="{{ old('company_name') }}">
                                @if ($errors->has('company_name'))
                                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="company_logo">Company Logo</label>
                                <input type="file" name="company_logo" class="form-control" id="company_logo">
                                @if ($errors->has('company_logo'))
                                    <span class="text-danger">{{ $errors->first('company_logo') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="currency">Currency</label>
                                <input type="text" name="currency" class="form-control" id="currency" placeholder="Enter Your Currency" value="{{ old('currency') }}">
                                @if ($errors->has('currency'))
                                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="pay_rate">Pay Rate</label>
                                <input type="text" name="pay_rate" class="form-control" id="pay_rate" placeholder="Enter Your Pay Rate" value="{{ old('pay_rate') }}">
                                @if ($errors->has('pay_rate'))
                                    <span class="text-danger">{{ $errors->first('pay_rate') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="vacation_hours">Vacation Hours</label>
                                <input type="text" name="vacation_hours" class="form-control" id="vacation_hours" placeholder="Enter Your Vacation Hours" value="{{ old('vacation_hours') }}">
                                @if ($errors->has('vacation_hours'))
                                    <span class="text-danger">{{ $errors->first('vacation_hours') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="sick_hours">Sick Hours</label>
                                <input type="text" name="sick_hours" class="form-control" id="sick_hours" placeholder="Enter Your Sick Hours" value="{{ old('sick_hours') }}">
                                @if ($errors->has('sick_hours'))
                                    <span class="text-danger">{{ $errors->first('sick_hours') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="form-group floating-label-form-group">
                                <label for="lunch_punch_hours">Auto Lunch Punch Hours</label>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <label class="form-check-label">    
                                            <input type="radio" class="form-check-input forDisable" name="lunch_punch_hours_status" value="disable">Disable
                                        </label>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input forEnable" name="lunch_punch_hours_status" value="enable">
                                            Enable
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                            @if ($errors->has('lunch_punch_hours_status'))
                                                <span class="text-danger">{{ $errors->first('lunch_punch_hours_status') }}</span>
                                            @endif
                                        
                                    </div>
                                </div>
                                <br>
                                <div class="row hideorshow d-none">
                                    <div class="col-md-6">
                                        <label for="lunch_punch_hours">Hours</label>
                                        <select class="form-control" id="user-code" name="lunch_punch_hours">
                                            <option value="">None</option>
                                            <!-- @foreach($lunch_hours as $key => $value)
                                                <option value="{{ $value }}" {{ $value == old('lunch_punch_hours') ? 'selected' : ''}}>{{ $value }}</option>
                                            @endforeach -->
                                            @foreach(range(0,24) as $number)
                                                <option value="{{ $number }}" {{ $number == old('lunch_punch_hours') ? 'selected' : ''}}>{{ $number }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('lunch_punch_hours'))
                                            <span class="text-danger">{{ $errors->first('lunch_punch_hours') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lunch_punch_hours">Minutes</label>
                                        <select class="form-control" id="user-code" name="lunch_punch_minute">
                                            <option value="">None</option>
                                            <!-- @foreach($lunch_hours as $key => $value)
                                                <option value="{{ $value }}" {{ $value == old('lunch_punch_minute') ? 'selected' : ''}}>{{ $value }}</option>
                                            @endforeach -->
                                            
                                            @foreach(range(0,60) as $number)
                                                <option value="{{ $number }}" {{ $number == old('lunch_punch_minute') ? 'selected' : ''}}>{{ $number }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('lunch_punch_minute'))
                                            <span class="text-danger">{{ $errors->first('lunch_punch_minute') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="form-group floating-label-form-group">
                                <label for="week_start">Week Start</label>

                                <select class="form-control" id="user-code" name="week_start">
                                    <option value="">None</option>
                                    @foreach($week_start as $key => $value)
                                        <option value="{{ $value }}" {{ $value == old('week_start') ? 'selected' : ''}}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('week_start'))
                                    <span class="text-danger">{{ $errors->first('week_start') }}</span>
                                @endif
                            </fieldset>

                            <button type="submit" class="btn btn-outline-primary btn-block"><i class="feather icon-user"></i> Register</button>
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
    <script type="text/javascript">
        
        $(document).on('click','.forEnable',function(e) {

            $(".hideorshow").removeClass('d-none');
        });
        $(document).on('click','.forDisable',function(e) {

            $(".hideorshow").addClass('d-none');
        });
    </script>
@endsection