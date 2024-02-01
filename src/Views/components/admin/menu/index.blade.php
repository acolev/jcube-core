@props([
    "item" => [],
    "admin" => null,
    "level" => 0,
])

@switch($item["link"]['type'] ?? 'link')
  @case('link')
    @php
      $hasRoute = isset($item["link"]['name']) && Route::has($item["link"]['name']);
      $hasAccess = !isset($item['access']) || @$admin?->access($item['access']);
      $hasChildren = isset($item['children']) && count($item['children']) > 0;
    @endphp

    @if($hasAccess)
      <li class="nav-item">
        @if($hasChildren)
          <a class="nav-link @if(!$level) menu-link @endif {{ menuActive($item["link"]['active'] ?? '', 3) }}"
             href="#sidebar{{titleToKey($item["name"])}}"
             data-bs-toggle="collapse"
             role="button"
             aria-expanded="false"
             aria-controls="sidebar{{titleToKey($item["name"])}}">
            @if($level == 0)
              <i class="{{ $item['icon'] ?? 'la la-circle' }}"></i>
            @endif
            <span>{{ __($item['name']) }}</span>
          </a>
          <div class="collapse menu-dropdown {{ menuActive($item["link"]['active'] ?? '', 4) }}"
               id="sidebar{{titleToKey($item["name"])}}">
            <ul class="nav nav-sm flex-column">
              @foreach($item['children'] as $menu)
                <x-menu :item="$menu" :user="$admin" :level="$level+1"/>
              @endforeach
            </ul>
          </div>
        @else
          <a href="{{ $hasRoute ? route($item["link"]['name'], $item["link"]['params'] ?? []) : '#' }}"
             class="nav-link @if(!$level) menu-link @endif  {{ menuActive($item["link"]['active'] ?? '', null, $item["link"]['params'] ?? []) }}">
            @if($level == 0)
              <i class="{{ $item['icon'] ?? 'la la-circle' }}"></i>
            @endif
            <span>{{ __($item['name']) }}</span>
          </a>
        @endif
      </li>
    @endif
    @break

  @case('title')
    @php $hasChildren = isset($item['children']) && count($item['children']) > 0; @endphp
    @if($hasChildren)
      <div class="menu-header" data-header="{{ __($item['name']) }}">
        @foreach($item['children'] as $menu)
          <x-menu :item="$menu" :user="$admin" :level="$level+1"/>
        @endforeach
      </div>
    @endif
    @break
@endswitch
