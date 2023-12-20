<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item"><a
            href="{{ route('admin.setting.notification.templates') }}">{{ __('Notification Templates') }}</a></li>
      <li class="breadcrumb-item active">{{ __('Notification Templates') }}</li>
    </ol>
  </x-admin::breadcrumb>

  <div class="row mb-5">
    <div class="col-xl-3">
      <div class="card">
        <div class="card-body p-0">
          <div class="table-responsive table-responsive--sm">
            <table class="table mb-0">
              <thead class="table-light">
              <tr>
                <th>@lang('Short Code')</th>
                <th>@lang('Description')</th>
              </tr>
              </thead>
              <tbody class="list">
              @forelse($template->shortcodes as $shortcode => $key)
                <tr>
                  <th><span class="short-codes">@php echo "{{". $shortcode ."}}"  @endphp</span></th>
                  <td>{{ __($key) }}</td>
                </tr>
              @empty
              @endforelse
              @isset($general->global_shortcodes)
                @foreach($general->global_shortcodes as $shortCode => $codeDetails)
                  <tr>
                    <td><span class="short-codes">@{{@php echo $shortCode @endphp}}</span></td>
                    <td>{{ __($codeDetails) }}</td>
                  </tr>
                @endforeach
              @endisset
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <form action="{{ route('admin.setting.notification.template.update',$template->id) }}" method="post">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h5 class="card-title text-white">@lang('Email Template')</h5>
              </div>
              <div class="card-body">
                <div class="row g-3">
                  <div class="col-md-12">
                    <div class="form-group">
                      <x-form.input type="toggle" label="Send Email" name="email_status" :value="$template->email_status" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Subject')</label>
                      <input type="text" class="form-control form-control-lg"
                             placeholder="@lang('Email subject')" name="subject"
                             value="{{ $template->subj }}" required/>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Message') <span class="text-danger">*</span></label>
                      <x-input type="html" name="email_body" :value="$template->email_body" type="short"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h5 class="card-title text-white">@lang('SMS Template')</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <x-form.input type="toggle" label="Send SMS" name="sms_status" :value="$template->sms_status" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Message')</label>
                      <textarea name="sms_body" rows="10" class="form-control"
                                placeholder="@lang('Your message using short-codes')"
                                required>{{ $template->sms_body }}</textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="hstack gap-2 justify-content-end mt-3">
          <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
          <button type="reset" class="btn btn-soft-success">{{__('Cancel')}}</button>
        </div>
      </form>
    </div>
  </div>


  @push('breadcrumb-plugins')
    <x-back route="{{ route('admin.setting.notification.templates') }}"/>
  @endpush
</x-dynamic-component>