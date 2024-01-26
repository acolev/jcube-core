<div @class(['hstack gap-2 justify-content-end', @$class])>
  <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
  @if(!@$hideCancel)
    <button type="reset" class="btn btn-soft-success">{{__('Cancel')}}</button>
  @endif
</div>
