<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <x-form.input name="name" value="{{$admin->name}}" label="First Name" placeholder="Enter your firstname"/>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="mb-3">
        <x-form.input name="last_name" value="{{@$admin->last_name}}" label="Last Name" placeholder="Enter your lastname"/>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="mb-3">
        <x-form.input name="phone" value="{{@$admin->phone}}" label="Phone Number" placeholder="Enter your phone number"/>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="mb-3">
        <x-form.input type="email" name="email" value="{{@$admin->email}}" label="Email Address" placeholder="Enter your email"/>
      </div>
    </div>
    @if(count($languages))
    <div class="col-lg-12">
      <div class="mb-3">
        <x-form.select  name="lang" value="{{@$admin->lang}}" label="Language" :variants="$languages"/>
      </div>
    </div>
    @endif
  </div>
  <div class="hstack gap-2 justify-content-end">
    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    <button type="reset" class="btn btn-soft-success">{{__('Cancel')}}</button>
  </div>
</form>