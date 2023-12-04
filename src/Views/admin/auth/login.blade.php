<x-admin::layout variant="Auth" :page-title="$pageTitle">

      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card mt-4">
            <div class="card-body p-4">
              <div class="text-center mt-2">
                <h5 class="text-primary">{{ __('Welcome Back!') }}</h5>
                <p class="text-muted">{{ __('Sign in to continue to') }} {{__(gs()->site_name ?: env('APP_NAME'))}}.</p>
              </div>
              <div class="p-2 mt-4">
                <form action="{{ route('admin.login') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <x-form.input label="Username" name="username" :placeholder="__('Enter your username')"/>
                  </div>
                  <div class="mb-3">
                    <div class="float-end">
                      <a href="{{ route('admin.password.reset') }}" class="text-muted">{{ __('Forgot password?') }}</a>
                    </div>
                    <x-form.input type="password" label="Password" name="password" :placeholder="__('Enter password')"/>
                  </div>
                  <div class="form-check">
                    <x-form.input type="checkbox" label="Remember me" name="remember" value="1" checked/>
                  </div>
                  <div class="mt-4">
                    <button class="btn btn-success w-100" type="submit">{{ __('Sign In') }}</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

</x-admin::layout>
