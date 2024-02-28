<form action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="row row-cols-xl-3 g-2">
    <div>
      <div class="form-group">
        <x-input type="password" name="old_password" value="" label="Password" required/>
      </div>
    </div>
    <div>
      <div class="form-group">
        <x-input type="password"  name="password" value="" label="New Password" required/>
      </div>
    </div>
    <div>
      <div class="form-group mb-3">
        <x-input type="password" name="password_confirmation" value="" label="Confirm Password" required/>
      </div>
    </div>
  </div>
  <x-admin::submit/>
</form>
