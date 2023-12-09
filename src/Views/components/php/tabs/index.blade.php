@php
  $id = Illuminate\Support\Str::random(12);
@endphp

<div class="{{ @$btnWrapperCls }}">
  <ul class="nav nav-tabs nav-primary {{ @$navCls }}" id="{{ $id }}" role="tablist" {{ $attributes }}>
    @stack($tabs)
    @if(isset($actions))
      <li class="col"></li>
      <li>
        <div class="btn-group">
          {{ $actions }}
        </div>
      </li>
    @endif
  </ul>
</div>
<div class="content {{ @$contentCls }}">
  <div class="tab-content" id="{{ $id }}">
    {{ $slot }}
  </div>
</div>

@pushonce('script')
  <script>
    $(".nav-tabs").find("li .nav-link").each(function (key, val) {
      $(val).on('click', function (el) {
        var href = new URL(location.href);
        href.searchParams.set('tab', $(el.target).attr("aria-controls"));
        window.history.pushState(location.data, location.title, href)
      })
    });
  </script>
@endpushonce
