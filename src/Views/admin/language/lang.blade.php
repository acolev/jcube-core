<x-admin.layout :page-title="$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item active">{{ __('Languages') }}</li>
    </ol>
  </x-admin::breadcrumb>

  <div class="alert alert-primary alert-dismissible alert-label-icon rounded-label fade show" role="alert">
    <i class="ri-question-fill label-icon"></i>
    {{ __('While you are adding a new keyword, it will only add to this current language only. Please be careful on entering a keyword, please make sure there is no extra space. It needs to be exact and case-sensitive.') }}
  </div>

  <div class="card">
    <div class="card-header border-0">
      <div class="row g-4 align-items-center">
        <div class="col-sm-3"></div>
        <div class="col-sm-auto ms-auto">
          <div class="hstack gap-2">
            <a href="#createModal" class="btn btn-success add-btn" data-bs-toggle="modal">
              <i class="ri-add-line align-bottom me-1"></i> {{ __('Add Language') }}
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive--sm table-responsive">
        <table class="table">
          <thead class="table-light">
          <tr>
            <th>@lang('Name')</th>
            <th>@lang('Code')</th>
            <th>@lang('Default')</th>
            <th style="width: 1%;">@lang('Actions')</th>
          </tr>
          </thead>
          <tbody>
          @forelse ($languages as $item)
            <tr>
              <td>{{__($item->name)}}</td>
              <td><strong>{{ __($item->code) }}</strong></td>
              <td>
                @if($item->is_default == 1)
                  <span class="badge bg-success-subtle text-success badge-border">{{ __('Default') }}</span>
                @else
                  <span class="badge bg-warning-subtle text-warning badge-border">{{ __('Selectable') }}</span>
                @endif
              </td>
              <td>
                <ul class="list-inline hstack gap-2 mb-0">
                  <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                      data-bs-placement="top" title="{{__('Translate')}}">
                    <a href="{{route('admin.language.key', $item->id)}}"
                       class="text-success">
                      <i class="la la-code"></i>
                    </a>
                  </li>
                  <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                      data-bs-placement="top" title="{{__('Edit')}}">
                    <a href="javascript:void(0)" class="editBtn"
                       data-url="{{ route('admin.language.update', $item->id)}}"
                       data-lang="{{ json_encode($item->only('name', 'code', 'is_default')) }}">
                      <i class="ri-pencil-fill align-bottom text-muted"></i>
                    </a>
                  </li>
                  @if($item->id != 1)
                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                        data-bs-placement="top" title="{{__('Remove')}}">
                      <button class="btn p-0 confirmationBtn"
                              data-question="@lang('Are you sure to remove this language from this system?')"
                              data-action="{{ route('admin.language.delete', $item->id) }}">
                        <i class="la la-trash"></i>
                      </button>
                    </li>
                  @endif
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
    </div>
  </div>


  {{-- NEW MODAL --}}
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0">
        <div class="modal-header p-3 bg-info-subtle">
          <h5 class="modal-title" id="createboardModalLabel">{{ __('Add New Language') }}</h5>
          <button type="button" class="btn-close" id="addBoardBtn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post" action="{{ route('admin.language.store')}}">
            @csrf
            <div class="row g-2">
              <div class="col-6">
                <x-input :value="old('name')" name="name" label="Language Name" required/>
              </div>
              <div class="col-6">
                <x-input :value="old('code')" name="code" label="Language Code" required/>
              </div>
              <div class="col-12">
                <x-input type="toggle" :value="old('is_default')" name="is_default" label="Default Language"/>
              </div>
              <div class="mt-4">
                <div class="hstack gap-2 justify-content-end">
                  <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- EDIT MODAL --}}
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0">
        <div class="modal-header p-3 bg-info-subtle">
          <h5 class="modal-title" id="createboardModalLabel">{{ __('Edit Language') }}</h5>
          <button type="button" class="btn-close" id="addBoardBtn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            @csrf
            <div class="row g-2">
              <div class="col-6">
                <x-input :value="old('name')" name="name" label="Language Name" required/>
              </div>
              <div class="col-6">
                <x-input :value="old('code')" name="code" label="Language Code" required/>
              </div>
              <div class="col-12">
                <x-input type="toggle" :value="old('is_default')" name="is_default" label="Default Language"/>
              </div>
              <div class="mt-4">
                <div class="hstack gap-2 justify-content-end">
                  <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <x-admin::confirmation-modal/>

  @push('script')
    <script>
      (function () {
        "use strict";
        $('.editBtn').on('click', function () {
          const modal = $('#editModal');
          const url = $(this).data('url');
          const lang = $(this).data('lang');
          console.log(lang)

          modal.find('form').attr('action', url);
          modal.find('input[name=name]').val(lang.name);
          modal.find('input[name=code]').val(lang.code);
          if (lang.is_default == 1) {
            modal.find('input[name=is_default]').attr('checked', true);
          } else {
            modal.find('input[name=is_default]').attr('checked', false);
          }
          modal.modal('show');
        });
      })();
    </script>
  @endpush
</x-admin.layout>
