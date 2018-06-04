<!DOCTYPE html>
<html>
<head>
    @include('admin.masterpage.head')
</head>
<body>
    @include('admin.masterpage.header')
    @include('admin.masterpage.sidebar')
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			@yield('content')
            @include('admin.masterpage.footer')
            
		</div>
	</div>
    @include('admin.masterpage.script')
	<script src="{{ URL::asset('admin/js/jquery-3.1.0.min.js')}}"></script>
	<script src="{{ URL::asset('admin/js/jquery-confirm.min.js') }}"></script>
    	<script src="{{ URL::asset('admin/js/underscore-min.js') }}"></script>
	<script src="{{ URL::asset('admin/js/admin.js')}}"></script>
</body>
</html>