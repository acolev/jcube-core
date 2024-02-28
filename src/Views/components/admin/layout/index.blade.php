@props([
	"variant" => null,
	'menu' => [],
	'layoutType' => null,
	'topbarColor' => null,
	'sidebarColor' => null,
	'sidebarSize' => null,
	'sidebarImage' => null,
	'preloader' => false,
	'layoutWidth' => null,
	'search' => false,
	'user' => auth('admin')->user(),
	'pageTitle' => '',
])

@extends('ui::layouts.' .$variant, [
    'topbarColor' => $topbarColor,
    'sidebarColor' => $sidebarColor,
    'sidebarSize' => $sidebarSize,
    'layoutWidth' => $layoutWidth,
    'preloader' => $preloader,
    'sidebarImage' => $sidebarImage,
])

@section('title', $pageTitle)
@section('content', $slot)

@section('aside-menu')
    <ul class="navbar-nav" id="navbar-nav">
        @foreach(config('adminMenu') as $item)
            <x-menu :item="$item" :admin="$user"/>
        @endforeach
    </ul>
@endsection

@section('topbar-right')
    @if($user)
        <div class="dropdown ms-sm-3 header-item topbar-user">
            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
              <span class="d-flex align-items-center">
                <img class="rounded-circle header-profile-user"
                     src="{{ getImage('assets/admin/images/profile/'.$user->image, '400x400') }}" alt="Header Avatar">
                <span class="text-start ms-xl-2">
                  <span
                      class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ implode(' ', [$user->name, $user->last_name]) }}</span>
                  <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ $user->job_title }}</span>
                </span>
              </span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <h6 class="dropdown-header">{{ __('Welcome') }} {{ $user->name }}</h6>
                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                    <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                    <span class="align-middle">{{__('Profile')}}</span>
                </a>
                <a class="dropdown-item" href="{{ route('admin.password') }}">
                    <i class="mdi mdi-key text-muted fs-16 align-middle me-1"></i>
                    <span class="align-middle">{{__('Password')}}</span>
                </a>
                <a class="dropdown-item" href="{{ route('admin.twofactor') }}">
                    <i class="mdi mdi-shield-account text-muted fs-16 align-middle me-1"></i>
                    <span class="align-middle">{{__('2FA Security')}}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                    <span class="align-middle" data-key="t-logout">{{__('Logout')}}</span></a>
            </div>
        </div>
    @endif
@endsection
