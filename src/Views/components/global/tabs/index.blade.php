@php
  $id = Illuminate\Support\Str::random(12);
@endphp

<div class="{{ @$btnWrapperCls }}">
  <ul class="nav nav-tabs nav-primary {{ @$navCls }}" id="{{ $id }}" role="tablist" {{ $attributes }}>
    @stack('tabs-buttons')
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