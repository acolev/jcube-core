<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <div class="row">
    <div class="col-lg-12">
      <div class="card b-radius--10 ">
        <div class="card-body p-0">
          <div class="table-responsive--md  table-responsive">
            <table class="table table--light style--two">
              <thead>
              <tr>
                <th>@lang('Name')</th>
                <th>@lang('Guard Name')</th>
                <th>@lang('Created at')</th>
                <th>@lang('Updated at')</th>
                <th>@lang('Action')</th>
              </tr>
              </thead>
              <tbody>
              @forelse($roles as $role)
                <tr>
                  <td>{{ $role->name }}</td>
                  <td>{{ $role->guard_name }}</td>
                  <td>
                    <div>
                      <span class="d-block text--small text--secondary">{{ showDateTime($role->created_at) }}</span>
                      <span>{{ diffForHumans($role->created_at) }}</span>
                    </div>
                  </td>
                  <td>
                    <div>
                      <span class="d-block text--small text--secondary">{{ showDateTime($role->updated_at) }}</span>
                      <span>{{ diffForHumans($role->updated_at) }}</span>
                    </div>
                  </td>
                  <td>
                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                       class="btn btn-sm btn-outline--primary">
                      <i class="la la-edit"></i>@lang('Edit')
                    </a>
                    <button type="button"
                            class="btn btn-sm btn-outline--danger confirmationBtn"
                            data-action="{{ route('admin.roles.remove',$role->id) }}"
                            data-question="@lang('Are you sure to remove this role')?">
                      <i class="la la-trash"></i>@lang('Remove')
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td class="text-muted text-center" colspan="100%">{{ __('No data') }}</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
        @if ($roles->hasPages())
          <div class="card-footer py-4">
            {{ paginateLinks($roles) }}
          </div>
        @endif
      </div>
    </div>
  </div>

  <x-confirmation-modal/>

  @push('breadcrumb-plugins')
    <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-outline--primary">
      <i class="la la-plus"></i>
      {{ __('Create') }}
    </a>
  @endpush
</x-dynamic-component>