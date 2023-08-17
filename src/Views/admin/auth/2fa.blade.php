<x-dynamic-component :component="$layoutComponent" :page-title="@$pageTitle">
    <section class="pt-50 pb-50 section--bg">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <h5 class="pb-3 text-center border-bottom">@lang('2FA Verification')</h5>
                        <form action="{{route('admin.go2fa.verify')}}" method="POST" class="submit-form">
                            @csrf

                            @include('admin::partials.verification_code')

                            <div class="form--group">
                                <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-dynamic-component>
