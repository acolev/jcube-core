@push(\view()->shared('tabs'))
  <li class="nav-item @if($is_active) active @endif" role="presentation">
    <button class="nav-link @if($is_active) active @endif" id="{{ $name }}-tab" data-bs-toggle="tab"
            data-bs-target="#{{ titleToKey($name) }}" type="button"
            role="tab" aria-controls="{{ $name }}"
            aria-selected="{{ $is_active ? 'true' : 'false' }}">{{ __($name) }}</button>
  </li>
@endpush

<div class="tab-pane fade @if($is_active)show active @endif" id="{{ titleToKey($name) }}" role="tabpanel"
     aria-labelledby="{{ $name }}-tab">
  {{ $slot }}
</div>

