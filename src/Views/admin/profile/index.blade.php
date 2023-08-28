<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
    <x-slot name="body">
        <x-admin::drawer>
            <x-admin::layout.part.breadcrumb :page-title="__('Profile Information')"/>
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
                        @if(count($languages))
                            <div class="form-group">
                                <label>@lang('Language')</label>
                                <select class="form-control" name="lang">
                                    @foreach($languages as $language)
                                        <option value="{{ $language->code }}" @selected($admin->lang === $language->code)>{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn--primary h-45 w-100">{{ __('Submit') }}</button>
            </form>

            <x-slot name="aside">
                <div @class(['px-5', 'py-4'])>
                    <h2>{{ __('Profile') }}</h2>
                </div>
                @include('admin::profile.part.menu')
            </x-slot>
        </x-admin::drawer>
    </x-slot>

    @push('breadcrumb-plugins')
        <a href="{{route('admin.password')}}" class="btn btn-sm btn-outline--primary">
            <i class="las la-key"></i> {{ __('Password Setting') }}
        </a>
    @endpush
</x-dynamic-component>