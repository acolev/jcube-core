@if($parent->cols <= $parent->max)
  <div>
    {{ $slot }}
  </div>
@else
  @php $is_active =  slug($active) === slug($name) @endphp
  @push($columns)
    <li class="nav-item @if($is_active) active @endif" role="presentation">
      <button class="nav-link @if($is_active) active @endif" id="{{ $id }}-tab" data-bs-toggle="tab"
              data-bs-target="#{{ $id }}" type="button"
              role="tab" aria-controls="{{ $id }}"
              aria-selected="{{ $is_active ? 'true' : 'false' }}">{{ __($name) }}</button>
    </li>
  @endpush
  <div class="tab-pane fade @if($is_active) show active @endif" id="{{ $id }}" role="tabpanel"
       aria-labelledby="{{ $name }}-tab">
    {{ $slot }}
  </div>
@endif
