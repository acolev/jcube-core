@php
    $active = !!$attributes['active'];
    $name = slug(@$attributes['name']);
    $title = __(@$attributes['name']);
@endphp

@push('tabs-buttons')
    <li class="nav-item @if($active) active @endif" role="presentation">
        <button class="nav-link @if($active) active @endif" id="{{ $name }}-tab" data-bs-toggle="tab"
                data-bs-target="#{{ $name }}" type="button"
                role="tab" aria-controls="{{ $name }}"
                aria-selected="{{ $active ? 'true' : 'false' }}">{{ $title }}</button>
    </li>
@endpush

<div class="tab-pane fade @if($active)show active @endif" id="{{ $name }}" role="tabpanel"
     aria-labelledby="{{ $name }}-tab">
    {{ $slot }}
</div>

@pushonce('script')
    <script>
      $(".nav-tabs").find("li .nav-link").each(function (key, val) {
        $(val).on('click', function (el) {
          var href = new URL(location.href);
          href.searchParams.set('tab', $(el.target).attr("aria-controls"));
          location.href = href;
        })
      });
    </script>
@endpushonce
