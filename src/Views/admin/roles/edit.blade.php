<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">{{ __('Roles') }}</a></li>
      <li class="breadcrumb-item active">{{ __('Edit') }}</li>
    </ol>
  </x-admin::breadcrumb>

  <form action="{{ route('admin.roles.save', $role->id) }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <x-form.input name="name" label="Name" :value="$role->name"/>
          </div>
          <div class="card-body">
            <div class="table-responsive table-card">
              <table class="table table-striped-columns mb-0">
                <thead class="table-light">
                <tr>
                  <th>{{ __('Permission') }}</th>
                  <th>{{ __('Read') }}</th>
                  <th>{{ __('Edit') }}</th>
                  <th>{{ __('Drop') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($permissions as $module=>$perms)
                  <tr>
                    <td>{{ $module }}</td>
                    <td>
                      @php $action = $module . ':Read'; @endphp
                      <input type="checkbox"
                             name="permissions[{{$action}}]"
                             value="1"
                             class="form-check-input"
                          @checked($role->hasAnyPermission($action, 'admin'))
                          @disabled(!$perms->where('action', 'Read')->first()) />

                    </td>
                    <td>
                      @php $action = $module . ':Edit'; @endphp
                      <input type="checkbox"
                             name="permissions[{{$action}}]"
                             value="1"
                             class="form-check-input"
                          @checked($role->hasAnyPermission($action, 'admin'))
                          @disabled(!$perms->where('action', 'Edit')->first()) />
                    </td>
                    <td>
                      @php $action = $module . ':Drop'; @endphp
                      <input type="checkbox"
                             name="permissions[{{$action}}]"
                             value="1"
                             class="form-check-input"
                          @checked($role->hasAnyPermission($action, 'admin'))
                          @disabled(!$perms->where('action', 'Drop')->first()) />
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4">
                      <div class="card card-body text-center">
                        {{ __('No Permissions to assign') }}
                      </div>
                    </td>
                  </tr>
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer  border-0">
            <div class="hstack gap-2 justify-content-end">
              <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
              <button type="reset" class="btn btn-soft-success">{{__('Cancel')}}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</x-dynamic-component>