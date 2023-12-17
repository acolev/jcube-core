@props([
	"pageTitle" => 'jCube Admin',
	"variant" => 'classic',
	'menu' => [],
	'layoutType' => null,
	'topbarColor' => null,
	'sidebarColor' => null,
	'sidebarSize' => null,
	'sidebarImage' => null,
	'preloader' => false,
	'layoutWidth' => null,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-layout="{{ $layoutType ?: 'vertical' }}"
      data-topbar="{{ $topbarColor ?: 'light' }}"
      data-sidebar="{{ $sidebarColor ?: 'dark' }}"
      data-sidebar-size="{{ $sidebarSize ?: 'lg' }}"
      data-sidebar-image="{{ $sidebarImage ?: 'none' }}"
      data-preloader="{{ $preloader ? "enable" : 'disable' }}"
      data-layout-width="{{ $layoutWidth  ?: 'fluid' }}"
>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ getMetaTitle($pageTitle) }}</title>

  <link rel="shortcut icon" type="image/png" href="{{getImage(getFilePath('logoIcon') .'/favicon.png')}}">

  <script src="{{ asset('admin_assets/js/layout.js') }}"></script>
  <script src="{{asset('admin_assets/js/theme.js')}}"></script>

  <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{asset('admin_assets/libs/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin_assets/css/icons.min.css') }}">

  @stack('style-lib')

  <link rel="stylesheet" href="{{ asset('admin_assets/css/app.css') }}">
  @if(file_exists('assets/admin/css/custom.css'))
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
  @endif

  @stack('style')
</head>
<body>
<x-dynamic-component :component="'admin::layout.' . strtolower($variant)"
                     :page-title="$pageTitle"
                     :menu="$menu" {{ $attributes }}>
  @if(isset($topBarOverride))
    <x-slot name="topBarOverride">{{ $topBarOverride }}</x-slot>
  @endif
  @if(isset($topBarLeft))
    <x-slot name="topBarLeft">{{ $topBarLeft }}</x-slot>
  @endif
  @if(isset($topBarRight))
    <x-slot name="topBarRight">{{ $topBarRight }}</x-slot>
  @endif
  @if(isset($mainMenu))
    <x-slot name="mainMenu">{{ $mainMenu }}</x-slot>
  @endif
  @if(isset($asidePre))
    <x-slot name="asidePre">{{ $asidePre }}</x-slot>
  @endif
  @if(isset($asidePost))
    <x-slot name="asidePost">{{ $asidePost }}</x-slot>
  @endif
  @if(isset($asideOverride))
    <x-slot name="asideOverride">{{ $asideOverride }}</x-slot>
  @endif
  {{ $slot }}
  <x-notify/>

  <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
  </button>
  <div id="preloader">
    <div id="status">
      <div class="spinner-border text-primary avatar-sm" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>


</x-dynamic-component>

@stack('modal-place')

<script src="{{asset('admin_assets/libs/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('admin_assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('admin_assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('admin_assets/js/plugins.js')}}"></script>
@stack('script-lib')


<script src="{{asset('admin_assets/js/app.js')}}"></script>

@stack('script')
</body>
</html>
