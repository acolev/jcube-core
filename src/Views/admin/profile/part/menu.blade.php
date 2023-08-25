<div class="list-group rounded-0">
    <a href="{{ route('admin.profile') }}"
            @class(['list-group-item list-group-item-action', 'list-group-item-primary' => menuActive('admin.profile')])
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
            @class(['list-group-item list-group-item-action', 'list-group-item-primary' => menuActive('admin.password')])
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
            @class(['list-group-item list-group-item-action', 'list-group-item-primary' => menuActive('admin.twofactor')])
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