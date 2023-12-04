<form action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="row row-cols-xl-3 g-2">
    <div>
      <div class="form-group">
        <x-form.input type="password" name="old_password" value="" label="Password" required/>
      </div>
    </div>
    <div>
      <div class="form-group">
        <x-form.input type="password"  name="password" value="" label="New Password" required/>
      </div>
    </div>
    <div>
      <div class="form-group mb-3">
        <x-form.input type="password" name="password_confirmation" value="" label="Confirm Password" required/>
      </div>
    </div>
  </div>
  <div class="hstack gap-2 justify-content-end">
    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    <button type="reset" class="btn btn-soft-success">{{__('Cancel')}}</button>
  </div>
</form>