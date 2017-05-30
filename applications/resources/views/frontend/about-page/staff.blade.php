@extends('frontend._layouts.basic')

@section('head-title')
<title>Sportopia - Our Staff</title>
@endsection

@section('meta')
<meta name="title" content="Sportopia">
<meta name="description" content="Sportopia - ">
<meta name="keywords" content="Sportopia " />
@endsection

@section('head-style')
<link rel="stylesheet" type="text/css" href="{{ asset('amadeo/css/frontend-publict-sub.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('amadeo/css/frontend-our-staff.css') }}">
@endsection

@section('body-content')
<?php // banner wrapper ?>
<div id="banner">
	<div class="banner-content" style="background-image: url('{{ asset('amadeo/main-image/banner.png') }}');"></div>
</div>
<?php // index and description wrapper ?>
<div id="iad" class="setup-wrapper">
	<div class="setup-content lar-wd">
		<div id="index-wrapper">
			<label>
				<a href="{{ Route('frontend.home') }}">
					Home
				</a>
			</label>
			<label>
				<a href="">
					Our Staff
				</a>
			</label>
		</div>
		<h2>Our Staff</h2>
	</div>
</div>
<?php // staff wrapper ?>
<div id="staff" class="setup-wrapper">
	<div class="setup-content lar-wd">
		<div class="staff-wrapper">
			@for($a=0; $a<=1; $a++)
			<div class="staff-content bar-size-4">
				<div class="img" style="background-image: url('{{ asset('amadeo/main-image/card.jpg')}}')"></div>
				<h2 class="name">
					Staff Name In Here
				</h2>
				<h2 class="jobs">
					Staff Job Title
				</h2>
				<hr>
				<p>Lorem ipsum dolor sit amet, quas assum volutpat ei vix, usu semper laoreet placerat an. Assum recteque te has, ad quidam euripidis eloquentiam sed</p>
			</div>
			@endfor
		</div>
		<div class="staff-wrapper">
			@for($a=0; $a<=7; $a++)
			<div class="staff-content bar-size-4">
				<div class="img" style="background-image: url('{{ asset('amadeo/main-image/card.jpg')}}')"></div>
				<h2 class="name">
					Staff Name In Here
				</h2>
				<h2 class="jobs">
					Staff Job Title
				</h2>
				<hr>
			</div>
			@endfor
		</div>

	</div>
</div>

@endsection

@section('footer-script')
<script src="{{ asset('plugin/bootstrap-3.3.7/js/bootstrap.min.js') }}"></script>
@endsection