@props([
	"pageTitle" => 'jCube Admin',
	"variant" => 'classic'
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>

    @stack('style-lib')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/icons/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/icons/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/css/admin.css')}}">
    @stack('style')
</head>
<body>


<x-dynamic-component :component="'admin::layout.' . strtolower($variant)">
    @if(isset($aside))
    <x-slot name="aside">{{ $aside }}</x-slot>
    @endif
    {{ $slot }}
</x-dynamic-component>


@stack('script-lib')
<script src="{{asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('admin_assets/js/admin.js')}}"></script>

@stack('script')
</body>
</html>
