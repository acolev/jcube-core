<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item active">{{ __('Email Settings') }}</li>
    </ol>
  </x-admin::breadcrumb>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="" method="POST">
          @csrf
          <div class="card-body">
            <div class="row align-items-end">
              <div class="col">
                <x-form.select name="email_method"
                               :value="$general->mail_config?->name"
                               label="Email Send Method"
                               :variants="[
                              'php' => 'PHP Mail',
                              'smtp' => 'SMTP',
                              'sendgrid' => 'SendGrid API',
                              'mailjet' => 'Mailjet API',
                              ]"
                />
              </div>
              <div class="col-auto">
                <button type="button" data-bs-target="#testMailModal" data-bs-toggle="modal" class="btn btn-success">
                  <i class="las la-paper-plane"></i> @lang('Send Test Mail')
                </button>
              </div>
            </div>
            <div class="row mt-4 d-none configForm g-3" id="smtp">
              <div class="col-md-12">
                <h6 class="mb-2">{{ __('SMTP Configuration') }}</h6>
              </div>
              <div class="col-md-4">
                <x-form.input placeholder="e.g. smtp.google.com" label="Host" name="host"
                              :value="$general->mail_config->host ?? ''"/>
              </div>
              <div class="col-md-4">
                <x-form.input placeholder="Available port" name="port" label="Port"
                              :value="$general->mail_config->port ?? ''"/>
              </div>
              <div class="col-md-4">
                <label>@lang('Encryption')</label>
                <x-form.select name="enc" :value="@$general->mail_config->enc"
                               :variants="['ssl' => 'SSL', 'tls' => 'TLS']"/>
              </div>
              <div class="col-md-6">
                <x-form.input placeholder="Normally your email address" label="Username" name="username"
                              :value="$general->mail_config->username ?? ''"/>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <x-form.input placeholder="Normally your email password" label="Password" name="password"
                                :value="$general->mail_config->password ?? ''"/>
                </div>
              </div>
            </div>
            <div class="row mt-4 d-none configForm g-3" id="sendgrid">
              <div class="col-md-12">
                <h6 class="mb-2">{{ __('SendGrid API Configuration') }}</h6>
              </div>
              <div class="col-md-12">
                <x-form.input placeholder="SendGrid App key" label="App Key" name="appkey"
                              :value="$general->mail_config->appkey ?? ''"/>
              </div>
            </div>
            <div class="row mt-4 d-none configForm g-3" id="mailjet">
              <div class="col-md-12">
                <h6 class="mb-2">@lang('Mailjet API Configuration')</h6>
              </div>
              <div class="col-md-6">
                <x-form.input placeholder="Mailjet Api Public Key" label="Api Public Key" name="public_key"
                              :value="$general->mail_config->public_key ?? ''"/>
              </div>
              <div class="col-md-6">
                <x-form.input placeholder="Mailjet Api Secret Key" label="Api Secret Key" name="secret_key"
                              :value="$general->mail_config->secret_key ?? ''"/>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="hstack gap-2 justify-content-end">
              <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
              <button type="reset" class="btn btn-soft-success" onclick="emailMethod('php')">{{__('Cancel')}}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- TEST MAIL MODAL --}}
  <x-admin::modal id="testMailModal" title="Test Mail Setup">
    <form action="{{ route('admin.setting.notification.email.test') }}" method="POST">
      @csrf
      <input type="hidden" name="id">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <x-form.input type="email" name="email" label="Sent to" class="form-control" placeholder="Email Address"/>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="hstack gap-2 justify-content-end">
          <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
      </div>
    </form>
  </x-admin::modal>

  @push('script')
    <script>
      function emailMethod(method) {
        $('.configForm').addClass('d-none');
        if (method != 'php') {
          $(`#${method}`).removeClass('d-none');
        }
      }

      (function () {
        var method = '{{ $general->mail_config?->name }}';
        if (method) emailMethod(method);
        $('select[name=email_method]').on('change', function () {
          var method = $(this).val();
          emailMethod(method);
        });
      })();

    </script>
  @endpush
</x-dynamic-component>