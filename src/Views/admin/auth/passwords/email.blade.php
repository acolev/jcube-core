<x-admin::layout variant="Auth" :page-title="$pageTitle">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
      <div class="card mt-4">
        <div class="card-body p-4">
          <div class="text-center mt-2">
            <h5 class="text-primary">{{ __('Forgot Password?') }}</h5>
            <p class="text-muted">{{ __('Reset password with') }} {{__(gs()->site_name ?: env('APP_NAME'))}}</p>

            <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c"
                       class="avatar-xl"></lord-icon>
          </div>
          <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
           {{ __('Enter your email and instructions will be sent to you!') }}
          </div>
          <div class="p-2">
            <form action="{{ route('admin.password.reset') }}" method="POST">
              @csrf
              <div class="mb-4">
                <x-input type="email" name="email" label="Email" :placeholder="__('Enter Email')"/>
              </div>

              <div class="text-center mt-4">
                <button class="btn btn-success w-100" type="submit">{{ __('Send Reset Link') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="mt-4 text-center">
        <p class="mb-0">
          {{ __('Wait, I remember my password...') }}
          <a href="{{ route('admin.login') }}" class="fw-semibold text-primary text-decoration-underline">
            Click here
          </a>
        </p>
      </div>

    </div>
  </div>
</x-admin::layout>

{{--<div class="min-vh-100 bg-white">--}}
{{--    <div class="row min-vh-100 no-gutters g-0">--}}
{{--        <div class="col-md-5 col-lg-4">--}}
{{--            <div class="align-items-center d-flex h-100 justify-content-center">--}}
{{--                <div class="w-75">--}}
{{--                    <h4 class="logo-text mb-15"><strong>{{ __('Recover Account') }}</strong></h4>--}}
{{--                    <form action="{{ route('admin.password.reset') }}" method="POST" class="cmn-form mt-30">--}}
{{--                        @csrf--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="email">@lang('Email')</label>--}}
{{--                            <input type="email" name="email" class="form-control b-radius--capsule" id="username"--}}
{{--                                   value="{{ old('email') }}" placeholder="@lang('Enter your email')">--}}
{{--                            <i class="las la-user input-icon"></i>--}}
{{--                        </div>--}}
{{--                        <div class="form-group d-flex justify-content-between align-items-center">--}}
{{--                            <a href="{{ route('admin.login') }}" class="text-muted text--small"><i--}}
{{--                                    class="las la-lock"></i>@lang('Login Here')</a>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Send Reset Code') <i--}}
{{--                                    class="las la-sign-in-alt"></i></button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-7 col-lg-8 d-none d-md-block">--}}
{{--            <img src="https://picsum.photos/1024/1000" alt="" class="login-image">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--@push('style')--}}
{{--    <link rel="stylesheet" href="{{asset('admin_assets/css/auth.css')}}">--}}
{{--@endpush--}}
