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
                <th>@lang('Email')</th>
                <th>@lang('Username')</th>
                <th>@lang('Joined At')</th>
                <th>@lang('Action')</th>
              </tr>
              </thead>
              <tbody>
              @forelse($staffs as $staff)
                <tr>
                  <td>{{ $staff->name }}</td>
                  <td>{{ $staff->email }}</td>
                  <td>{{ $staff->username }}</td>
                  <td>
                    <div>
                      <span class="d-block">{{ showDateTime($staff->created_at) }}</span>
                      <span>{{ diffForHumans($staff->created_at) }}</span>
                    </div>
                  </td>
                  <td>
                    <div class="btn--group">
                      <x-offcanvas id="userEdit-{{ $staff->id  }}" width="30vw" :title="'Edit:' . $staff->username">
                        <x-slot name="button">
                          <button class="btn btn-sm btn-outline--primary" type="button"
                                  data-bs-toggle="offcanvas"
                                  data-bs-target="#userEdit-{{ $staff->id  }}"
                                  role="button"
                                  aria-controls="userEdit-{{ $staff->id  }}">
                            <i class="la la-pencil"></i> {{ __('Edit') }}
                          </button>
                        </x-slot>
                        <form method="POST" action="{{ route('admin.staff.save', $staff->id) }}"
                              class="text-start h-100">
                          @csrf
                          <div class="d-flex flex-column h-100">
                            <div>
                              <div class="form-group">
                                <label class="form-label">{{ __('Name') }}</label>
                                <x-form.input type="string" required name="name" :value="$staff->name"/>
                              </div>
                              <div class="form-group">
                                <label class="form-label">{{ __('Email') }}</label>
                                <x-form.input type="string" required name="email" :value="$staff->email"/>
                              </div>
                              <div class="form-group">
                                <label class="form-label">{{ __('Username') }}</label>
                                <x-form.input type="string" required name="username" :value="$staff->username"/>
                              </div>
                              <div class="form-group">
                                <label class="form-label">{{ __('Roles') }}</label>
                                <div class="row">
                                  <x-form.select name="roles[]" multiple :value="$staff->roles" :variants="$roles"/>
                                </div>
                              </div>
                            </div>
                            <div class="flex-grow-1"></div>
                            <div>
                              <button type="submit" class="btn btn--primary w-100 h-45">{{ __('Submit') }}</button>
                            </div>
                          </div>
                        </form>
                      </x-offcanvas>
                      @if ($staff->status!==1)
                        <button type="button"
                                class="btn btn-sm btn-outline--danger confirmationBtn"
                                data-action="{{ route('admin.staff.remove',$staff->id) }}"
                                data-question="@lang('Are you sure to remove this staff')?">
                          <i class="la la-trash"></i>@lang('Remove')
                        </button>
                      @endif
                    </div>
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
        @if ($staffs->hasPages())
          <div class="card-footer py-4">
            {{ paginateLinks($staffs) }}
          </div>
        @endif
      </div>
    </div>
  </div>

  <x-confirmation-modal/>

  @push('breadcrumb-plugins')
    <x-search-form placeholder="Username / Email"/>
    <x-offcanvas id="addUser" width="30vw" title="Add Staff">
      <x-slot name="button">
        <button class="btn btn-sm btn-outline--primary" type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#addUser"
                role="button"
                aria-controls="addUser">
          <i class="las la-plus"></i> {{ __('Add New') }}
        </button>
      </x-slot>
      <form method="POST" action="{{ route('admin.staff.save') }}" class="text-start h-100">
        @csrf
        <div class="d-flex flex-column h-100">
          <div>
            <div class="form-group">
              <label class="form-label">{{ __('Name') }}</label>
              <x-form.input type="string" required name="name" :value="old('name')"/>
            </div>
            <div class="form-group">
              <label class="form-label">{{ __('Email') }}</label>
              <x-form.input type="string" required name="email" :value="old('email')"/>
            </div>
            <div class="form-group">
              <label class="form-label">{{ __('Username') }}</label>
              <x-form.input type="string" required name="username" autocomplete="one-time-code" :value="old('username')"/>
            </div>
            <div class="form-group">
              <label class="form-label">{{ __('Password') }}</label>
              <x-form.input type="password" required name="password" autocomplete="one-time-code" :value="old('password')"/>
            </div>
            <div class="form-group">
              <label class="form-label">{{ __('Roles') }}</label>
              <div class="row">
                <x-form.select name="roles[]" multiple :variants="$roles" :value="old('roles') ?: []"/>
              </div>
            </div>
          </div>
          <div class="flex-grow-1"></div>
          <div>
            <button type="submit" class="btn btn--primary w-100 h-45">{{ __('Submit') }}</button>
          </div>
        </div>
      </form>
    </x-offcanvas>
  @endpush
  @push('script')
    <script>
      "use strict";
      (function ($) {
        let modal = $("#modal");
        $('.addBtn').on('click', function (e) {
          let action = "{{ route('admin.staff.save') }}";
          modal.find('form').trigger('reset')
          modal.find(`input[name=password]`).closest('.form-group').removeClass('d-none')
          modal.find('form').attr('action', action);
          $(`input[type=checkbox]`).attr('checked', false);
          $(modal).find('.modal-title').text('New Staff');
          $(modal).modal('show')
        });
        $('.editBtn').on('click', function (e) {

          let action = "{{ route('admin.staff.save',':id') }}";
          let edit = $(this).data('edit');

          $(`input[type=checkbox]`).attr('checked', false);

          $.each(edit.access_permissions || [], function (i, permission) {
            $(`input[value=${permission.toLowerCase().replace(/\s+/g, '_')}]`).attr('checked', true);
          });

          modal.find(`input[name=password]`).closest('.form-group').addClass('d-none');
          modal.find(`input[name=name]`).val(edit.name);
          modal.find(`input[name=email]`).val(edit.email);
          modal.find(`input[name=username]`).val(edit.username);

          modal.find('form').attr('action', action.replace(':id', edit.id));
          $(modal).find('.modal-title').text('Update Staff');
          $(modal).modal('show');
        });
      })(jQuery);

    </script>
  @endpush
</x-dynamic-component>