@php
  if(!isset($adminNotificationCount)) $adminNotificationCount = 0;
  if(!isset($adminNotifications)) $adminNotifications = [];
  $user = auth()->guard('admin')->user();
@endphp

<header id="page-topbar">
  <div class="layout-width">
    <div class="navbar-header">
      <div class="d-flex">
        <div class="navbar-brand-box horizontal-logo">
          <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
               <img src="{{ storage_asset(getConfig('logos')->favicon, '22x22') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
              <img src="{{ storage_asset(getConfig('logos')->logo_dark, '100x17') }}" alt="" height="17">
            </span>
          </a>

          <a href="{{route('admin.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
               <img src="{{ storage_asset(getConfig('logos')->favicon, '22x22') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ storage_asset(getConfig('logos')->logo, '100x17') }}" alt="" height="17">
            </span>
          </a>
        </div>
        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                id="topnav-hamburger-icon">
          <span class="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </button>

        @if($search)
          <x-admin::layout.part.appSearch :menu="$menu"/>
        @endif

        @isset($headerLeft) {{ $headerLeft }} @endisset
      </div>

      <div class="d-flex align-items-center">

        @isset($headerRight) {{ $headerRight }} @endisset

        <div class="dropdown d-md-none topbar-head-dropdown header-item">
          <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                  id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-search fs-22"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
               aria-labelledby="page-header-search-dropdown">
            <form class="p-3">
              <div class="form-group m-0">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                  <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="ms-1 header-item d-none d-sm-flex">
          <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                  data-toggle="fullscreen">
            <i class='bx bx-fullscreen fs-22'></i>
          </button>
        </div>

        <div class="ms-1 header-item d-none d-sm-flex">
          <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
            <i class='bx bx-moon fs-22'></i>
          </button>
        </div>

        @if(isset($user))
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
      </div>
    </div>
  </div>
</header>
