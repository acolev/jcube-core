<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item active">{{ __('Staff') }}</li>
    </ol>
  </x-admin::breadcrumb>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row g-4 align-items-center">
            <div class="col-sm-3">
              <div class="search-box">
                <x-form.input class="search" placeholder="Search for..."/>
                <i class="ri-search-line search-icon"></i>
              </div>
            </div>
            <div class="col-sm-auto ms-auto">
              <div class="hstack gap-2">
                <button type="button" class="btn btn-success add-btn"
                        data-target="#userForm" onclick="newUser(this)">
                  <i class="ri-add-line align-bottom me-1"></i> {{ __('Add Staff') }}
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div>
            <div class="table-responsive table-card">
              <table class="table align-middle">
                <thead class="table-light">
                <tr>
                  <th scope="col" style="width: 50px;">
                    {{__('Id')}}
                  </th>

                  <th>{{__('Name')}}</th>
                  <th>{{__('Job Title')}}</th>
                  <th>{{__('Email')}}</th>
                  <th>{{('Phone')}}</th>
                  <th>{{__('Create at')}}</th>
                  <th style="width: 1%;">{{__('Action')}}</th>
                </tr>
                </thead>
                <tbody class="list form-check-all">
                @forelse($staffs as $staff)
                  <tr>
                    <th scope="row">
                      {{ $staff->id }}
                    </th>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                          <img src="{{ getImage('assets/admin/images/profile/'.$staff->image, '400x400') }}" alt=""
                               class="avatar-xxs rounded-circle image_src object-fit-cover">
                        </div>
                        <div class="flex-grow-1 ms-2 name">{{ $staff->name }} {{ $staff->last_name }}</div>
                      </div>
                    </td>
                    <td class="job_title">{{ $staff->job_title ?: '---' }}</td>
                    <td class="email">{{ $staff->email }}</td>
                    <td class="phone">{{ $staff->phone ?: '---' }}</td>
                    <td class="date">
                      <div class="text-nowrap">
                        <span class="d-block small text-secondary">{{ showDateTime($staff->created_at) }}</span>
                        <span>{{ diffForHumans($staff->created_at) }}</span>
                      </div>
                    </td>
                    <td>
                      <ul class="list-inline hstack gap-2 mb-0">
                        @if(false)
                          <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                              data-bs-placement="top" title="{{__('View')}}">
                            <a href="javascript:void(0);"><i class="ri-eye-fill align-bottom text-muted"></i></a>
                          </li>
                        @endif
                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                            data-bs-placement="top" title="{{__('Edit')}}">
                          <a href="#" data-target="#userForm" data-form="#user-{{$staff->id}}"
                             onclick="editUser(this, {{$staff->id}})">
                            <i class="ri-pencil-fill align-bottom text-muted"></i>
                          </a>
                          <script type="application/json" id="user-{{$staff->id}}">
                            {
                              "id": "{{$staff->id}}",
                              "avatar": "{{$staff->image}}",
                              "name": "{{$staff->name}}",
                              "last_name": "{{$staff->last_name}}",
                              "username": "{{$staff->username}}",
                              "job_title": "{{$staff->job_title}}",
                              "phone": "{{$staff->phone}}",
                              "email": "{{$staff->email}}",
                              "status": "{{$staff->status}}",
                              "roles": @json($staff->roles)
                            }
                          </script>
                        </li>
                        @if ($staff->root!==1)
                          <li class="list-inline-item">
                            <button type="button" class="btn p-0 remove-item-btn confirmationBtn"
                                    data-action="{{ route('admin.staff.remove',$staff->id) }}"
                                    data-question="@lang('Are you sure to remove this staff')?"
                                    data-text="@lang('Deleting your staff will remove all of your information from our database.')?"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                    title="{{__('Delete')}}">
                              <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                            </button>
                          </li>
                        @endif
                      </ul>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td>11</td>
                  </tr>
                @endforelse
                </tbody>
              </table>
              <div class="noresult" style="display: none">
                <div class="text-center">
                  <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                             colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                  <h5 class="mt-2">Sorry! No Result Found</h5>
                  <p class="text-muted mb-0">We've searched more than 150+ leads We did not find any leads for you
                    search.</p>
                </div>
              </div>
            </div>
            @if ($staffs->hasPages())
              <div class="d-flex justify-content-end mt-3">
                <div class="pagination-wrap hstack gap-2" style="display: flex;">
                  {{ $staffs->links() }}
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <x-admin::modal id="userForm" title="Edit Staff">
    <form method="POST" action="{{ route('admin.staff.save') }}" class="text-start" autocomplete="one-time-code"
          enctype="multipart/form-data">
      @csrf
      <input type="hidden" id="id" name="id"/>
      <div class="modal-body">
        <div class="text-center">
          <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
            <img src="{{ getImage(null,getFileSize('adminProfile')) }}"
                 class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
              <input id="profile-img-file-input" type="file" class="profile-img-file-input" name="image">
              <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
              </label>
            </div>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-6">
            <div class="form-group">
              <label class="form-label">{{ __('Name') }}</label>
              <x-form.input type="string" required name="name" :value="old('name')"/>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label class="form-label">{{ __('Last Name') }}</label>
              <x-form.input type="string" name="last_name" :value="old('last_name')"/>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label class="form-label">{{ __('Phone') }}</label>
              <x-form.input type="string" name="phone" :value="old('phone')"/>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label class="form-label">{{ __('Email') }}</label>
              <x-form.input type="email" required name="email" :value="old('email')"/>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label class="form-label">{{ __('Username') }}</label>
              <x-form.input type="string" required name="username" :value="old('username')"/>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label class="form-label">{{ __('Job Title') }}</label>
              <x-form.select type="auto" required name="job_title" :value="old('job_title') ?: []"
                             :variants="$jobTitles" multiple :max-items="1"/>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label class="form-label">{{ __('Password') }}</label>
              <x-form.input type="password" required name="password" :value="old('password')" autocomplete="one-time-code"/>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label class="form-label">{{ __('Roles') }}</label>
              <div class="row">
                <x-form.select name="roles[]" multiple :value="old('roles') ?: []" :variants="$roles"/>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <x-form.input type="toggle" name="status" label="Active" :value="old('status') ?: []"/>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary w-100 h-45">{{ __('Submit') }}</button>
      </div>
    </form>
  </x-admin::modal>
  <x-admin::confirmation-modal/>

  @push('script')
    <script>
      function editUser(el, id) {
        const target = el.dataset.target;
        $(target + ' form').attr('action', '{{ route('admin.staff.save') }}/' + id);
        $(target + ' [name="password"]').attr('disabled', true);
        $(target + ' .modal-title').text('{{__('Edit Staff')}}');
        $(target + ' .user-profile-image').attr('src', '{{ getImage(null,getFileSize('adminProfile')) }}');

        fillForm(el, function (el) {
          if (el.avatar) {
            $(target + ' .user-profile-image').attr('src', '/assets/admin/images/profile/' + el.avatar);
          }
          $(target).modal('show')
        });
      }

      function newUser(el) {
        const target = el.dataset.target;
        $(target + ' form').attr('action', '{{ route('admin.staff.save') }}');
        $(target + ' [name="password"]').attr('disabled', false);
        $(target + ' .modal-title').text('{{__('Create Staff')}}');
        $(target + ' .user-profile-image').attr('src', '{{ getImage(null,getFileSize('adminProfile')) }}');
        document.querySelector(target + ' form').reset();
        $(target).modal('show')
        $(target + ' .form-control').trigger('change');
      }
    </script>
  @endpush
</x-dynamic-component>