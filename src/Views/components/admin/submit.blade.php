<div @class(['hstack gap-2 justify-content-end', @$class])>
  <button type="submit" class="btn btn-primary">{{ __($submitText ?: 'Submit') }}</button>
  @if(!@$hideCancel)
    <button type="reset" class="btn btn-soft-success">{{__($cancelText ?: 'Cancel')}}</button>
  @endif
</div>
