@php
 $admin =   auth()->guard('admin')->user();
@endphp
<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">

    <x-slot name="body">
        <x-admin::drawer>
            <x-slot name="title">{{ __('2FA Security') }}</x-slot>

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

            @include('admin::profile.part.menu')
        </x-admin::drawer>
    </x-slot>
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