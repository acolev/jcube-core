<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item active">{{ __('Global Template') }}</li>
    </ol>
  </x-admin::breadcrumb>
  <div class="row">
    <div class="col-xl-3">
      <div class="card">
        <div class="card-header">
          <h6 class="card-title">@lang('Global Short Codes')</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive table-responsive--sm">
            <table class=" table align-items-center table--light">
              <thead class="table-light">
              <tr>
                <th>@lang('Short Code') </th>
                <th>@lang('Description')</th>
              </tr>
              </thead>
              <tbody class="list">
              <tr>
                <td><span class="short-codes">@{{fullname}}</span></td>
                <td>@lang('Full Name of User')</td>
              </tr>
              <tr>
                <td><span class="short-codes">@{{username}}</span></td>
                <td>@lang('Username of User')</td>
              </tr>
              <tr>
                <td><span class="short-codes">@{{message}}</span></td>
                <td>@lang('Message')</td>
              </tr>
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
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.config.update', 'notify') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-12">
                <x-input placeholder="Email address" label="Email Sent From" name="email_from"
                              :value="$general->email_from" required/>
              </div>
              <div class="col-md-12">
                <x-input type="html" type="full" label="Email Body" name="email_template" :value="$general->email_template"/>
              </div>
              <div class="col-md-12">
                <x-input placeholder="SMS Sent From" label="SMS Sent From" name="sms_from" :value="$general->sms_from" required />
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>@lang('SMS Body') </label>
                  <x-input type="text" :value="$general->sms_body" rows="4" placeholder="SMS Body" name="sms_body" required />
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
    </div>
  </div>
</x-dynamic-component>
