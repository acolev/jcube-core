<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
  <button type="button"
          class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
          id="page-header-notifications-dropdown"
          data-bs-toggle="dropdown"
          data-bs-auto-close="outside"
          aria-haspopup="true"
          aria-expanded="false">
    <i class='bx bx-bell fs-22'></i>
    <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">
      {{ $adminNotificationCount }} <span class="visually-hidden">unread messages</span>
    </span>
  </button>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
       aria-labelledby="page-header-notifications-dropdown">

    <div class="dropdown-head bg-primary bg-pattern rounded-top">
      <div class="p-3">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="m-0 fs-16 fw-semibold text-white"> {{ __('Notifications') }} </h6>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-content position-relative" id="notificationItemsTabContent">
      <div data-simplebar style="max-height: 300px;" class="pe-2">

        @forelse($adminNotifications as $notification)
          <div class="text-reset notification-item d-block dropdown-item position-relative">
            <div class="d-flex">
              <div class="avatar-xs me-3 flex-shrink-0">
                <span
                    class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                    <i class="bx bx-badge-check"></i>
                </span>
              </div>
              <div class="flex-grow-1">
                <a href="{{ route('admin.notification.read',$notification->id) }}" class="stretched-link">
                  <h6 class="mt-0 mb-2 lh-base">{{ $notification->title }}</h6>
                </a>
                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                  <span><i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</span>
                </p>
              </div>
            </div>
          </div>
        @empty
          <div class="empty-notification-elem">
            <div class="w-25 w-sm-50 pt-3 mx-auto">
              <img src="{{ asset('admin_assets/images/svg/bell.svg') }}" class="img-fluid" alt="user-pic">
            </div>
            <div class="text-center pb-5 mt-2">
              <h6 class="fs-18 fw-semibold lh-base">{{ __('Hey! You have no any notifications') }}</h6>
            </div>
          </div>
        @endforelse

        @if($adminNotificationCount)
          <div class="my-3 text-center view-all">
            <a href="{{ route('admin.notifications') }}" class="btn btn-soft-success waves-effect waves-light">
              {{ __('View All Notifications') }} <i class="ri-arrow-right-line align-middle"></i></a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
