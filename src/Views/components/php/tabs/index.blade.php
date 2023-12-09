<div class="{{ @$classes['wrapper'] }}">
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
