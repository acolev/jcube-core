<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <div class="row">
    <div class="col-lg-12">
      <form action="{{ route('admin.roles.save') }}" method="POST">
        @csrf
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <x-form.input name="name" label="Name" :value="old('name')"/>
            </div>
          </div>
        </div>
        <h5 class="mt-5 mb-3">{{ __('Permissions') }}</h5>
        <div class="row row-cols-md-3 g-3">
          @forelse($permissions as $module=>$perms)
            <div>
              <div class="card">
                <div class="card-title pt-2 px-3 fw-semibold">{{ $module }}</div>
                <div class="card-body">
                  <table class="table">
                    @foreach($perms as $action)
                      <tr>
                        <td class="p-1">{{ $action->action }}</td>
                        <td width="1%" class="p-1">
                          <x-form.input type="toggle" name="permissions[{{$action->name}}]"
                                        value=""/>
                        </td>
                      </tr>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
          @empty
            <div>
              <div class="card card-body text-center">
                {{ __('No Permissions to assign') }}
              </div>
            </div>
          @endforelse
        </div>
        <hr class="my-4">
        <div class="text-end">
          <button class="btn btn-outline--secondary rounded-pill" type="reset">{{ __('Cancel') }}</button>
          <button class="btn btn--primary rounded-pill">{{ __('Save') }}</button>
        </div>
      </form>
    </div>
  </div>


  @push('breadcrumb-plugins')
    <x-back :route="route('admin.roles.index')"/>
  @endpush
</x-dynamic-component>