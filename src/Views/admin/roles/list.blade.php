<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item active">{{ __('Roles') }}</li>
    </ol>
  </x-admin::breadcrumb>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row g-4 align-items-center">
            <div class="col-sm-3">
              <div class="search-box">
                <x-form.input class="search" placeholder="Search for..." />
                <i class="ri-search-line search-icon"></i>
              </div>
            </div>
            <div class="col-sm-auto ms-auto">
              <div class="hstack gap-2">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-success add-btn">
                  <i class="ri-add-line align-bottom me-1"></i> {{ __('Add Role') }}
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div>
            <div class="table-responsive table-card">
              <table class="table">
                <thead class="table-light">
                <tr>
                  <th>@lang('Name')</th>
                  <th>@lang('Guard Name')</th>
                  <th>@lang('Created at')</th>
                  <th>@lang('Updated at')</th>
                  <th style="width: 1%;">@lang('Action')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($roles as $role)
                  <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    <td>
                      <div class="text-nowrap">
                        <span class="d-block small text-secondary">{{ showDateTime($role->created_at) }}</span>
                        <span>{{ diffForHumans($role->created_at) }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="text-nowrap">
                        <span class="d-block small text-secondary">{{ showDateTime($role->updated_at) }}</span>
                        <span>{{ diffForHumans($role->updated_at) }}</span>
                      </div>
                    </td>
                    <td>
                      <ul class="list-inline hstack gap-2 mb-0">
                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="{{__('View')}}">
                          <a href="{{ route('admin.roles.edit', $role->id) }}">
                            <i class="ri-pencil-fill align-bottom text-muted"></i>
                          </a>
                        </li>
                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="{{__('Delete')}}">
                          <button type="button"
                                  class="btn p-0 remove-item-btn confirmationBtn"
                                  data-action="{{ route('admin.roles.remove',$role->id) }}"
                                  data-question="@lang('Are you sure to remove this role')?">
                            <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                          </button>
                        </li>
                      </ul>
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
            @if ($roles->hasPages())
              <div class="d-flex justify-content-end mt-3">
                <div class="pagination-wrap hstack gap-2" style="display: flex;">
                  {{ $roles->links() }}
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</x-dynamic-component>