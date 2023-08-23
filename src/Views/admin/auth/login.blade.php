<x-admin::layout variant="Empty" :page-title="$pageTitle">
    <div class="min-vh-100 bg-white">
        <div class="row min-vh-100 no-gutters g-0">
            <div class="col-md-5 col-lg-4">
                <div class="align-items-center d-flex h-100 justify-content-center">
                    <div class="w-75">
                        <h4 class="logo-text mb-3">@lang('Welcome to')
                            <strong>{{__(gs()->site_name ?: env('APP_NAME'))}}</strong></h4>
                        <p>{{__($pageTitle)}} @lang('to')  {{__(gs()->site_name ?: env('APP_NAME'))}} @lang('dashboard')</p>
                        <form action="{{ route('admin.login') }}" method="POST" class="cmn-form mt-5">
                            @csrf
                            <div class="form-group">
                                <label for="email">@lang('Username')</label>
                                <div class="input-icon">
                                    <input type="text" name="username" class="form-control" id="username"
                                           value="{{ old('username') }}" placeholder="{{ __('Enter your username') }}">
                                    <i class="las la-user icon right"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass">@lang('Password')</label>
                                <div class="input-icon">
                                    <input type="password" name="password" class="form-control" id="pass"
                                           placeholder="{{ __('Enter your password') }}">
                                    <i class="las la-lock icon right"></i>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.password.reset') }}" class="text-muted text--small">
                                    <i class="las la-lock"></i> {{ __('Forgot password?') }}</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-btn mt-25 btn btn-primary">
                                    {{ __('Login') }} <i class="las la-sign-in-alt"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-8 d-none d-md-block">
                <img src="https://picsum.photos/1024/1000" alt="" class="login-image">
            </div>
        </div>
    </div>

    @push('style')
        <link rel="stylesheet" href="{{asset('admin_assets/css/auth.css')}}">
    @endpush
</x-admin::layout>


