@php
 $admin =   auth()->guard('admin')->user();
@endphp
<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 mb-30">
            <div class="card overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex p-3 bg--primary align-items-center">
                        <div class="avatar avatar--lg">
                            <img src="{{ getImage(getFilePath('adminProfile').'/'. $admin->image, getFileSize('adminProfile'))}}"
                                 alt="{{ __('Avatar') }}">
                        </div>
                        <div class="ps-3">
                            <h4 class="text--white">{{__($admin->name)}}</h4>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Name')
                            <span class="fw-bold">{{__($admin->name)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="fw-bold">{{__($admin->username)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            <span class="fw-bold">{{$admin->email}}</span>
                        </li>

                    </ul>
                </div>
            </div>

            @if($admin?->ts)
                <div class="card custom--card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">@lang('Disable 2FA Security')</h5>
                    </div>
                    <form action="{{route('admin.twofactor.disable')}}" method="POST">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="key" value="{{$secret}}">
                            <div class="form-group">
                                <label class="form-label">@lang('Google Authenticatior OTP')</label>
                                <input type="text" class="form-control form--control" name="code" required>
                            </div>
                            <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="card custom--card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">@lang('Enable 2FA Security')</h5>
                    </div>
                    <form action="{{ route('admin.twofactor.enable') }}" method="POST">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="key" value="{{$secret}}">
                            <div class="form-group">
                                <label class="form-label">@lang('Google Authenticatior OTP')</label>
                                <input type="text" class="form-control form--control" name="code" required>
                            </div>
                            <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>

        <div class="col-xl-9 col-lg-8 mb-30">
            @if(!$admin?->ts)
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('Add Your Account')</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3">
                            @lang('Use the QR code or setup key on your Google Authenticator app to add your account. ')
                        </h6>
                        <div class="form-group mx-auto text-center">
                            <img class="mx-auto" src="{{$qrCodeUrl}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">@lang('Setup Key')</label>
                            <div class="input-group">
                                <input type="text" name="key" value="{{$secret}}"
                                       class="form-control form--control referralURL" readonly>
                                <button type="button" class="input-group-text copytext bg--base text-white" id="copyBoard">
                                    <i class="fa fa-copy"></i></button>
                            </div>
                        </div>
                        <label><i class="fa fa-info-circle"></i> @lang('Help')</label>
                        <p>@lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')
                            <a class="text--base"
                               href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                               target="_blank">@lang('Download')</a></p>
                    </div>
                </div>
            @endif
        </div>

    </div>
    @push('style')
        <style>
            .copied::after {
                background-color: var(--primary);
            }
        </style>
    @endpush

    @push('script')
        <script>
          (function ($) {
            "use strict";
            $('#copyBoard').click(function () {
              var copyText = document.getElementsByClassName("referralURL");
              copyText = copyText[0];
              copyText.select();
              copyText.setSelectionRange(0, 99999);
              /*For mobile devices*/
              document.execCommand("copy");
              copyText.blur();
              this.classList.add('copied');
              setTimeout(() => this.classList.remove('copied'), 1500);
            });
          })(jQuery);
        </script>
    @endpush
</x-dynamic-component>