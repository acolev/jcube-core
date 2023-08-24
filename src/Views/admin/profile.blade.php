<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 mb-30">

            <div class="card overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex p-3 bg--primary align-items-center">
                        <div class="avatar avatar--lg">
                            <img src="{{ getImage(getFilePath('adminProfile').'/'. $admin->image, getFileSize('adminProfile'))}}"
                                 alt="{{ __('Avatar') }}">
                        </div>
                        <div class="ps-3">
                            <h4 class="text--white">{{__($admin->name)}}</h4>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Name')
                            <span class="fw-bold">{{__($admin->name)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="fw-bold">{{__($admin->username)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            <span class="fw-bold">{{$admin->email}}</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">@lang('Profile Information')</h5>

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview">
                                                    <img src="{{ getImage(getFilePath('adminProfile').'/'.$admin->image,getFileSize('adminProfile')) }}"
                                                         alt="{{ __('Avatar') }}">
                                                    <button type="button" class="remove-image">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image"
                                                       id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1"
                                                       class="bg--success">@lang('Upload Image')</label>
                                                <small class="mt-2  ">@lang('Supported files'): <b>@lang('jpeg')
                                                        , @lang('jpg'), @lang('png')
                                                        .</b> @lang('Image will be resized into 400x400px') </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>@lang('Name')</label>
                                    <input class="form-control" type="text" name="name" value="{{ $admin->name }}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Email')</label>
                                    <input class="form-control" type="email" name="email" value="{{ $admin->email }}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Language')</label>
                                    <select class="form-control" name="lang">
                                        @foreach($languages as $language)
                                            <option value="{{ $language->code }}" @selected($admin->lang === $language->code)>{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('breadcrumb-plugins')
        <a href="{{route('admin.password')}}" class="btn btn-sm btn-outline--primary">
            <i class="las la-key"></i> {{ __('Password Setting') }}
        </a>
    @endpush
</x-dynamic-component>