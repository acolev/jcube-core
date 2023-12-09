<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
  <x-admin::breadcrumb :page-title="$pageTitle">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home"></i></a></li>
      <li class="breadcrumb-item active">{{ __('Logos') }}</li>
    </ol>
  </x-admin::breadcrumb>

  <div class="alert alert-primary alert-dismissible alert-label-icon rounded-label fade show" role="alert">
    <i class="ri-question-fill label-icon"></i>
    {{ __('If the logo and favicon are not changed after you update from this page, please') }}
    <span class="text-danger">{{ __('clear the cache') }}</span>
    {{ __('from your browser. As we keep the filename the same after the update, it may show the old image for the cache. usually, it works after clear the cache but if you still see the old logo or favicon, it may be caused by server level or network level caching. Please clear them too.') }}
  </div>

  <div class="card">
    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="form-group col-lg-3">
            <div class="image-upload">
              <div class="thumb">
                <div class="avatar-preview">
                  <div class="profilePicPreview logoPicPrev  bg-dark"
                       style="background-image: url({{ getImage(getFilePath('logoIcon').'/logo.png', '?'.time()) }})">
                    <button type="button" class="remove-image"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="avatar-edit">
                  <input type="file" class="profilePicUpload" id="profilePicUpload1"
                         accept=".png, .jpg, .jpeg" name="logo">
                  <label for="profilePicUpload1"
                         class="bg-primary text-white">{{ __('Select Logo') }}</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group col-lg-3">
            <div class="image-upload">
              <div class="thumb">
                <div class="avatar-preview">
                  <div class="profilePicPreview logoPicPrev bg-white"
                       style="background-image: url({{ getImage(getFilePath('logoIcon').'/logo_dark.png', '?'.time()) }})">
                    <button type="button" class="remove-image"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="avatar-edit">
                  <input type="file" class="profilePicUpload" id="profilePicUpload3"
                         accept=".png, .jpg, .jpeg" name="logo_dark">
                  <label for="profilePicUpload3" class="bg-primary text-white">{{ __('Select Dark Logo') }}</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group col">
            <div class="image-upload">
              <div class="thumb">
                <div class="avatar-preview">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="profilePicPreview logoPicPrev"
                           style="background-image: url({{ getImage(getFilePath('logoIcon') .'/favicon.png', '?'.time()) }})">
                        <button type="button" class="remove-image"><i
                              class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="col-sm-6 mt-sm-0 mt-4">
                      <div class="profilePicPreview logoPicPrev bg--dark"
                           style="background-image: url({{ getImage(getFilePath('logoIcon') .'/favicon.png', '?'.time()) }})">
                        <button type="button" class="remove-image"><i
                              class="fa fa-times"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="avatar-edit">
                  <input type="file" class="profilePicUpload" id="profilePicUpload2"
                         accept=".png" name="favicon">
                  <label for="profilePicUpload2" class="bg-primary text-white">@lang('Select Favicon')</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <x-admin::submit @class('mt-3')/>
      </form>
    </div>
  </div>

</x-dynamic-component>