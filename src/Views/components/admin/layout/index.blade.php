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
	'search' => false,
])
    <!DOCTYPE html>
<x-admin::layout.part.settings :layout="strtolower($variant)" :topbar-color="$topbarColor"
                               :sidebar-color="$sidebarColor"
                               :sidebar-size="$sidebarSize" :sidebar-image="$sidebarImage" :layout-width="$layoutWidth"
                               :preloader="$preloader"/>
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

@switch (strtolower($variant))
  @case('empty')
    @php($layout = 'empty')
  @break
  @case('auth')
    @php($layout = 'auth')
  @break
  @default
    @php($layout = 'classic')
  @break
@endswitch

<x-dynamic-component :component="'admin::layout.'.$layout"
                     :page-title="$pageTitle"
                     :menu="$menu"
                     :search="$search" {{ $attributes }}>
  @if(isset($topBarOverride))
    <x-slot name="topBarOverride">{{ $topBarOverride }}</x-slot>
  @endif
  @if(isset($headerLeft))
    <x-slot name="headerLeft">{{ $headerLeft }}</x-slot>
  @endif
  @if(isset($headerRight))
    <x-slot name="headerRight">{{ $headerRight }}</x-slot>
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
<script src="{{asset('admin_assets/js/rhm.js')}}"></script>
<script src="{{asset('admin_assets/js/plugins.js')}}"></script>
@stack('script-lib')


<script src="{{asset('admin_assets/js/app.js')}}"></script>

@stack('script')
</body>
</html>
