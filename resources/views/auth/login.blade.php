@extends('layouts.loginsMaster')
@section('content')
<section class="mainSection">
	<div class="AuthDivImg">
		<img src="/ProjectImages/homelogin.jpg" class="authImg" />
	</div>
</section>
<div class="SignLoginText">
	Sign Up or Login as a:
</div>
<div class="authButtonDiv">
	<a href="/login-doctor" class="authButton">Doctor</a>
	<a href="/login-patient" class="authButton">Patient</a>
</div>
@endsection