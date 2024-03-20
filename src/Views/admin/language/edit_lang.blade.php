<x-admin.layout :page-title="$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.language.index')}}">{{ __('Languages') }}</a></li>
      <li class="breadcrumb-item active">{{ __($pageTitle) }}</li>
    </ol>
  </x-admin::breadcrumb>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row justify-content-between">
            <div class="col"></div>
            <div class="col-md-auto">
              <div class="hstack text-nowrap gap-2">
                <button type="button" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-soft-success">
                  <i class="mdi mdi-plus"></i> {{ __('Import Keywords') }}
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success">
                  <i class="mdi mdi-plus"></i> {{ __('Add New Key') }}
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive--sm table-responsive">
            <table class="table white-space-wrap" id="myTable">
              <thead class="table-light">
              <tr>
                <th>{{ __('Key') }}</th>
                <th>{{__('Translation')}}</th>
                <th style="width: 1%;">{{ __('Action') }}</th>
              </tr>
              </thead>
              <tbody>
              @forelse($json as $k => $language)
                <tr>
                  <td class="white-space-wrap">{{$k}}</td>
                  <td class="text-left white-space-wrap">{{$language}}</td>
                  <td>
                    <ul class="list-inline hstack gap-2 mb-0">
                      <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                          data-bs-placement="top" title="{{__('Edit')}}">
                        <a href="javascript:void(0)"
                           data-bs-target="#editModal"
                           data-bs-toggle="modal"
                           data-title="{{$k}}"
                           data-key="{{$k}}"
                           data-value="{{$language}}"
                           class="editModal">
                          <i class="ri-pencil-fill align-bottom text-muted"></i>
                        </a>
                      </li>
                      <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                          data-bs-placement="top" title="{{__('Delete')}}">
                        <a href="javascript:void(0)"
                           data-key="{{$k}}"
                           data-value="{{$language}}"
                           data-bs-toggle="modal" data-bs-target="#DelModal"
                           class="deleteKey">
                          <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                        </a>
                      </li>
                    </ul>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="100%" class="text-center">{{ __('No Data') }}</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-admin::modal id="addModal" title="Add New">
    <form action="{{route('admin.language.store.key',$lang->id)}}" method="post">
      @csrf
      <div class="modal-body">
        <div class="row row-cols-2">
          <div>
            <label for="key">@lang('Key')</label>
            <x-input id="key" name="key" value="{{old('key')}}" label="Key" required/>
          </div>
          <div>
            <x-input id="value" name="value" value="{{old('value')}}" label="Value" required/>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <div class="hstack gap-2 justify-content-end">
          <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
      </div>
    </form>
  </x-admin::modal>
  <x-admin::modal id="editModal" title="Edit">
    <form action="{{route('admin.language.update.key',$lang->id)}}" method="post">
      @csrf
      <div class="modal-body">
        <label for="inputName" class="form-title"></label>
        <input type="text" class="form-control" name="value" required>
        <input type="hidden" name="key">
      </div>
      <div class="modal-footer">
        <div class="hstack gap-2 justify-content-end">
          <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
      </div>
    </form>
  </x-admin::modal>
  <x-admin::modal id="DelModal" title="Confirmation Alert!">
    <div class="modal-body p-5 text-center">
      <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                 colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
      <div class="mt-4 text-center">
        <h4 class="fs-semibold question"></h4>
        <p class="text-muted fs-14 mb-4 pt-1 text"></p>
        <div class="hstack gap-2 justify-content-center remove">
          <form action="{{route('admin.language.delete.key',$lang->id)}}" method="post">
            @csrf
            <input type="hidden" name="key">
            <input type="hidden" name="value">
            <button type="button" class="btn btn-link link-success fw-medium text-decoration-none"
                    data-bs-dismiss="modal">
              <i class="ri-close-line me-1 align-middle"></i> {{ __('Close') }}
            </button>
            <button class="btn btn-danger" id="delete-record">{{ __('Yes, Delete It!!') }}</button>
          </form>
        </div>
      </div>
    </div>
  </x-admin::modal>
  <x-admin::modal id="importModal" title="Import Language">
    <form action="{{route('admin.language.import.lang')}}" method="post">
      @csrf
      <input type="hidden" name="toLangid" value="{{$lang->id}}">
      <div class="modal-body">
        <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label fade show" role="alert">
          <i class="ri-alert-line label-icon"></i>
          {{ __('If you import keywords, Your current keywords will be removed and replaced by imported keyword') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="form-group">
          <x-input type="select" :variants="$list_lang->pluck('name', 'id')" name="id" required/>
        </div>
      </div>
      <div class="modal-footer">
        <div class="hstack gap-2 justify-content-end">
          <button type="submit" class="btn btn-primary import_lang">{{ __('Submit') }}</button>
        </div>
      </div>
    </form>
  </x-admin::modal>

  <div class="modal fade" id="importModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">@lang('Import Language')</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
              class="las la-times"></i></button>
        </div>
        <div class="modal-body">
          <p
            class="text-center text--danger">@lang('If you import keywords, Your current keywords will be removed and replaced by imported keyword')</p>
          <div class="form-group">
            <select class="form-control select_lang" required>
              <option value="">@lang('Select One')</option>
              @foreach($list_lang as $data)
                <option value="{{$data->id}}"
                        @if($data->id == $lang->id) class="d-none" @endif >{{__($data->name)}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn--dark" data-bs-dismiss="modal">@lang('Close')</button>
          <button type="button" class="btn btn--primary import_lang"> @lang('Import Now')</button>
        </div>
      </div>
    </div>
  </div>

  @push('script')
    <script>
      (function () {
        "use strict";
        $(document).on('click', '.deleteKey', function () {
          var modal = $('#DelModal');
          modal.find('input[name=key]').val($(this).data('key'));
          modal.find('input[name=value]').val($(this).data('value'));
        });
        $(document).on('click', '.editModal', function () {
          var modal = $('#editModal');
          modal.find('.form-title').text($(this).data('title'));
          modal.find('input[name=key]').val($(this).data('key'));
          modal.find('input[name=value]').val($(this).data('value'));
        });
      })();
    </script>
  @endpush
</x-admin.layout>

