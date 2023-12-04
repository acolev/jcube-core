@props([
	'menu' => [],
])
@php $admin = auth()->guard('admin')->user(); @endphp

<div class="app-menu navbar-menu">
  <div class="navbar-brand-box">
    <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
      <span class="logo-sm">
        <img src="{{getImage(getFilePath('logoIcon') .'/favicon.png')}}" alt="">
      </span>
      <span class="logo-lg">
        <img src="{{getImage(getFilePath('logoIcon') .'/logo_dark.png')}}" alt="">
      </span>
    </a>
    <a href="{{route('admin.dashboard')}}" class="logo logo-light">
      <span class="logo-sm">
        <img src="{{getImage(getFilePath('logoIcon') .'/favicon.png')}}" alt="">
      </span>
      <span class="logo-lg">
        <img src="{{getImage(getFilePath('logoIcon') .'/logo.png')}}" alt="">
      </span>
    </a>
    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
      <i class="ri-record-circle-line"></i>
    </button>
  </div>

  <div id="scrollbar">
    <div class="container-fluid">
      <div id="two-column-menu">
      </div>
      <ul class="navbar-nav" id="navbar-nav">
        <li class="menu-title"><span data-key="t-menu">{{ __('Menu') }}</span></li>
        @foreach($menu as $item)
          <x-admin::menu :item="$item" :admin="$admin"/>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="sidebar-background"></div>
</div>