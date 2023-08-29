<x-slot name="aside">
    <div @class(['px-5', 'py-4'])>
        <h2>{{ __('Profile') }}</h2>
    </div>
    <div class="drawer-menu">
        <a href="{{ route('admin.profile') }}"
                @class(['active' => menuActive('admin.profile')])
        >
            <div class="d-flex py-2">
                <div class="me-3">
                    <i class="la la-user-circle la-2x"></i>
                </div>
                <div>
                    <b>{{ __('Account') }}</b>
                    <p>{{ __('Manage your profile information') }}</p>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.password') }}"
                @class(['active' => menuActive('admin.password')])
        >
            <div class="d-flex py-2">
                <div class="me-3">
                    <i class="la la-key la-2x"></i>
                </div>
                <div>
                    <b>{{ __('Password') }}</b>
                    <p>{{ __('Manage your password') }}</p>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.twofactor') }}"
                @class(['active' => menuActive('admin.twofactor')])
        >
            <div class="d-flex py-2">
                <div class="me-3">
                    <i class="la la-shield-alt la-2x"></i>
                </div>
                <div>
                    <b>{{ __('2fa Security') }}</b>
                    <p>{{ __('Enable 2FA Security') }}</p>
                </div>
            </div>
        </a>
    </div>
</x-slot>

