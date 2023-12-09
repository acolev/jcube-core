<div class="row">
  <div class="col-md-6">
    @if(!$admin?->ts)
      <h5 class="card-title">@lang('Add Your Account')</h5>
      <h6 class="mb-3">
        @lang('Use the QR code or setup key on your Google Authenticator app to add your account. ')
      </h6>
      <div class="form-group mx-auto text-center">
        <img class="mx-auto" src="{{$qrCodeUrl}}" alt="QR code" width="200" height="200">
      </div>
      <div class="form-group mt-3">
        <label class="form-label">{{ __('Setup Key') }}</label>
        <div class="input-group">
          <input type="text" name="key" value="{{$secret}}"
                 class="form-control form--control referralURL" readonly>
          <button type="button" class="input-group-text copytext bg-primary text-white" id="copyBoard">
            <i class="mdi mdi-clipboard"></i>
          </button>
        </div>
      </div>
      <label class="mt-3"><i class="fa fa-info-circle"></i> @lang('Help')</label>
      <p>@lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.')
        <a class="text--base"
           href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
           target="_blank">@lang('Download')</a></p>
    @endif
  </div>
  <div class="col-md-6">
    @if($admin?->ts)
      <h5 class="card-title">@lang('Disable 2FA Security')</h5>
      <form action="{{route('admin.twofactor.disable')}}" method="POST">
        <div class="card-body">
          @csrf
          <input type="hidden" name="key" value="{{$secret}}">
          <div class="form-group mb-3">
            <x-form.input name="code" value="" label="Google Authenticatior OTP" required/>
          </div>
          <x-admin::submit/>
        </div>
      </form>
    @else
      <h5 class="card-title">@lang('Enable 2FA Security')</h5>
      <form action="{{ route('admin.twofactor.enable') }}" method="POST">
        @csrf
        <input type="hidden" name="key" value="{{$secret}}">
        <div class="form-group mb-3">
          <x-form.input name="code" value="" label="Google Authenticatior OTP" required/>
        </div>
        <x-admin::submit/>
      </form>
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