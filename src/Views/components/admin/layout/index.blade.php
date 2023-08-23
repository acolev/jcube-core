@props([
	"pageTitle" => 'jCube Admin',
	"variant" => 'classic'
])
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ getMetaTitle($pageTitle) }}</title>

    <link rel="shortcut icon" type="image/png" href="{{getImage(getFilePath('logoIcon') .'/favicon.png')}}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap-toggle/bootstrap-toggle.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/icons/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/icons/css/line-awesome.min.css')}}">

    @stack('style-lib')

    <link rel="stylesheet" href="{{asset('admin_assets/vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/css/app.css')}}">

    @stack('style')
</head>
<body>

<x-dynamic-component :component="'admin::layout.' . strtolower($variant)" :page-title="$pageTitle">
    @if(isset($topBarLeft)) <x-slot name="topBarLeft">{{ $topBarLeft }}</x-slot> @endif
    @if(isset($topBarRight)) <x-slot name="topBarRight">{{ $topBarRight }}</x-slot> @endif
    @if(isset($mainMenu)) <x-slot name="mainMenu">{{ $mainMenu }}</x-slot> @endif
    @if(isset($asidePre)) <x-slot name="asidePre">{{ $asidePre }}</x-slot> @endif
    @if(isset($asidePost)) <x-slot name="asidePost">{{ $asidePost }}</x-slot>  @endif
    @if(isset($body)) <x-slot name="body">{{ $body }}</x-slot> @else {{ $slot }} @endif
    <x-notify/>
</x-dynamic-component>


<script src="{{asset('admin_assets/vendor/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('admin_assets/vendor/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/slimscroll/jquery.slimscroll.min.js')}}"></script>


@stack('script-lib')

<script src="{{asset('admin_assets/vendor/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin_assets/js/app.js')}}"></script>

@stack('script')
</body>
</html>
