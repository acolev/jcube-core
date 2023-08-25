<x-admin::layout variant="Empty" :page-title="$pageTitle">
    <div class="min-vh-100 bg-white">
        <div class="row min-vh-100 no-gutters g-0">
            <div class="col-md-5 col-lg-4">
                <div class="align-items-center d-flex h-100 justify-content-center">
                    <div class="w-75">
                        <h4 class="logo-text mb-15"><strong>{{ __('Recover Account') }}</strong></h4>
                        <form action="{{ route('admin.password.reset') }}" method="POST" class="cmn-form mt-30">
                            @csrf
                            <div class="form-group">
                                <label for="email">@lang('Email')</label>
                                <input type="email" name="email" class="form-control b-radius--capsule" id="username"
                                       value="{{ old('email') }}" placeholder="@lang('Enter your email')">
                                <i class="las la-user input-icon"></i>
                            </div>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.login') }}" class="text-muted text--small"><i
                                            class="las la-lock"></i>@lang('Login Here')</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Send Reset Code') <i
                                            class="las la-sign-in-alt"></i></button>
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