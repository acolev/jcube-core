<x-dynamic-component variant="auth" :component="$layoutComponent" :page-title="@$pageTitle">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
      <div class="card mt-4">

        <div class="card-body p-4">
          <div class="mb-4">
            <div class="avatar-lg mx-auto">
              <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                <i class="ri-qr-code-fill"></i>
              </div>
            </div>
          </div>

          <div class="p-2 mt-4">
            <div class="text-muted text-center mb-4 mx-lg-3">
              <h4>{{ __('2FA Verification') }}</h4>
            </div>

            <form action="{{route('admin.go2fa.verify')}}" method="POST" class="submit-form">
              @csrf
              @include('admin::partials.verification_code')
            </form>
            <div class="mt-3">
              <button type="button" class="btn btn-success w-100">Confirm</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-dynamic-component>
