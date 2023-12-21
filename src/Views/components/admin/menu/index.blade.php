@props([
	"item" => [],
	"admin" => null,
	"level" => 0,
])
@switch($item["link"]['type'])
  @case('link')
    @if((!isset($item["link"]['name']) || Route::has($item["link"]['name'])) && (!isset($item['access']) || @$admin?->access($item['access'])) )
      <li class="nav-item">
        @if(isset($item['children']))
          <a class="nav-link @if(!$level) menu-link @endif {{ menuActive(@$item["link"]['active'], 3) }}"
             href="#sidebar{{titleToKey($item["name"])}}"
             data-bs-toggle="collapse"
             role="button"
             aria-expanded="true"
             aria-controls="sidebar{{titleToKey($item["name"])}}">
            <i class="{{ @$item['icon'] ?: 'la la-circle' }}"></i>
            <span>{{ __(@$item['name']) }}</span>
          </a>
          <div class="collapse menu-dropdown {{ menuActive(@$item["link"]['active'], 4) }}"  id="sidebar{{titleToKey($item["name"])}}">
            <ul class="nav nav-sm flex-column">
              @foreach($item['children'] as $menu)
                @php $menu['icon'] = null @endphp
                <x-admin::menu :item="$menu" :admin="@$admin" :level="$level+1"/>
              @endforeach
            </ul>
          </div>
        @else
          <a href="{{ isset($item["link"]['name']) ? route(@$item["link"]['name'], @$item["link"]['params']) : 'javascript:void(0)'}}"
             class="nav-link @if(!$level) menu-link @endif  {{ menuActive($item["link"]['active'], null, @$item["link"]['params']) }}">
            @isset($item['icon'])
              <i class="{{ @$item['icon'] }}"></i>
            @endif
            <span>{{ __(@$item['name']) }}</span>
          </a>
        @endif
      </li>

    @endif
    @break
  @case('title')
      @if(isset($item['children']))
        <li class="menu-title">
          <i class="ri-more-fill"></i>
          <span>{{ __($item['name']) }}</span>
        </li>
        @foreach($item['children'] as $menu)
          <x-admin::menu :item="$menu" :admin="@$admin"/>
        @endforeach
      @endif
    @break
@endswitch