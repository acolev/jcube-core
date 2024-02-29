<x-admin::layout variant="empty" :page-title="$pageTitle">
    <div class="min-vh-100 bg-white">
        <div class="row min-vh-100 no-gutters g-0">
            <div class="col-md-5 col-lg-4">
                <div class="align-items-center d-flex h-100 justify-content-center">
                    <div class="w-75">
                        <h4 class="logo-text mb-15"><strong>@lang('Recover Account')</strong></h4>
                        <form action="{{ route('admin.password.verify.code') }}" method="POST" class="cmn-form mt-30">
                            @csrf
                            <div class="form-group">
                                <label>@lang('Verification Code')</label>
                                <input type="text" name="code" id="code" class="form-control">
                            </div>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.password.reset') }}"
                                   class="text-muted text--small">@lang('Try to send again')</a>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Verify Code') <i
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

    @push('script')
        <script>
          (function ($) {
            "use strict";
            $('#code').on('input change', function () {
              var xx = document.getElementById('code').value;
              $(this).val(function (index, value) {
                value = value.substr(0, 7);
                return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
              });
            });
          })(jQuery)
        </script>
    @endpush
</x-admin::layout>
