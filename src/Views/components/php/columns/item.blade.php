@if($parent->cols <= $parent->max)
  <div>
    {{ $slot }}
  </div>
@else
  @php $is_active =   slug($active) === slug($name) @endphp
  @push($columns)
    <li class="nav-item @if($is_active) active @endif" role="presentation">
      <button class="nav-link @if($is_active) active @endif" id="{{ $id .'_'. slug($name) }}-tab" data-bs-toggle="tab"
              data-bs-target="#{{ $id .'_'. slug($name) }}" type="button"
              role="tab" aria-controls="{{ $id .'_'. slug($name) }}"
              aria-selected="{{ $is_active ? 'true' : 'false' }}">{{ __($name) }}</button>
    </li>
  @endpush
  <div class="tab-pane fade @if($is_active) show active @endif" id="{{ $id .'_'. slug($name) }}" role="tabpanel"
       aria-labelledby="{{ $name }}-tab">
    {{ $slot }}
  </div>
@endif
