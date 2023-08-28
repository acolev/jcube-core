<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
    <x-slot name="body">
        <x-admin::drawer>
            <x-admin::layout.part.breadcrumb :page-title="__('Change Password')"/>
            <form action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>@lang('Password')</label>
                    <input class="form-control" type="password" name="old_password" required>
                </div>

                <div class="form-group">
                    <label>@lang('New Password')</label>
                    <input class="form-control" type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label>@lang('Confirm Password')</label>
                    <input class="form-control" type="password" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn--primary w-100 btn-lg h-45">@lang('Submit')</button>
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
        <a href="{{route('admin.profile')}}" class="btn btn-sm btn-outline--primary">
            <i class="las la-user"></i> {{ __('Profile Setting') }}
        </a>
    @endpush
</x-dynamic-component>

