<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item active">{{ __('Notification Templates') }}</li>
    </ol>
  </x-admin::breadcrumb>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body p-0">
          <div class="table-responsive--sm table-responsive">
            <table class="table mb-0">
              <thead class="table-light">
              <tr>
                <th>@lang('Name')</th>
                <th>@lang('Subject')</th>
                <th style="width: 1%;">@lang('Action')</th>
              </tr>
              </thead>
              <tbody>
              @forelse($templates as $template)
                <tr>
                  <td>{{ __($template->name) }}</td>
                  <td>{{ __($template->subj) }}</td>
                  <td>
                    <ul class="list-inline hstack gap-2 mb-0">
                      <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                          data-bs-placement="top" title="{{__('Edit')}}">
                        <a href="{{ route('admin.setting.notification.template.edit', $template->id) }}"
                           class="editGatewayBtn">
                          <i class="ri-pencil-fill align-bottom text-muted"></i>
                        </a>

                      </li>
                    </ul>
                  </td>
                </tr>
              @empty
                <tr>
                  <td class="text-muted text-center" colspan="100%">{{ __('No Data') }}</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-dynamic-component>
