<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle" no-body>

  <div class="position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg profile-setting-img">
      <img src="{{ Vite::asset('vendor/jcube/ui/src/Resources/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
      <div class="overlay-content">
        <div class="text-end p-3 d-none">
          <div class="p-0 ms-auto rounded-circle profile-photo-edit">
            <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
            <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
              <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-xxl-3">
      <div class="card mt-n5">
        <div class="card-body p-4">
          <div class="text-center">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                <img src="{{ getImage(getFilePath('adminProfile').'/'.$admin->image,getFileSize('adminProfile')) }}"
                     class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                  <input id="profile-img-file-input" type="file" class="profile-img-file-input" name="image"
                         oninput="submit()">
                  <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                  </label>
                </div>
              </div>
            </form>
            <h5 class="fs-16 mb-1">{{ implode(' ', [$admin->name, $admin->last_name]) }}</h5>
            <p class="text-muted mb-0">{{ @$admin->job_title }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xxl-9">
      <div class="card mt-xxl-n5">
        <div class="card-header">
          <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
            <li class="nav-item">
              <a class="nav-link {{ menuActive('admin.profile') }}" href="{{ route('admin.profile') }}" role="tab">
                <i class="fas fa-home"></i> {{ __('Personal Details') }}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ menuActive('admin.password') }}" href="{{ route('admin.password') }}" role="tab">
                <i class="far fa-user"></i> {{ __('Change Password') }}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ menuActive('admin.twofactor') }}" href="{{ route('admin.twofactor') }}" role="tab">
                <i class="far fa-envelope"></i> {{ __('2fa Security') }}
              </a>
            </li>
          </ul>
        </div>
        <div class="card-body p-4">
          @include('admin::profile.part.'.$part)
        </div>
      </div>
    </div>
  </div>
</x-dynamic-component>
