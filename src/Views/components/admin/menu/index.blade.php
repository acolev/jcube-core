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
             aria-expanded="false"
             aria-controls="sidebar{{titleToKey($item["name"])}}">
            <i class="{{ @$item['icon'] ?: 'la la-circle' }}"></i>
            <span>{{ __(@$item['name']) }}</span>
          </a>
          <div class="collapse menu-dropdown {{ menuActive(@$item["link"]['active'], 4) }}" id="sidebar{{titleToKey($item["name"])}}">
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
            @isset($item['icon']) <i class="{{ @$item['icon'] }}"></i> @endif
            <span>{{ __(@$item['name']) }}</span>
          </a>
        @endif
      </li>
      {{--            @if(isset($item['children']))--}}
      {{--                <li class="sidebar-menu-item {{ @$item['children'] ? 'sidebar-dropdown' : '' }}">--}}
      {{--                    <a href="javascript:void(0)"--}}
      {{--                       class="nav-link nav-parent-{{titleToKey(@$item['name'])}} {{ menuActive(@$item["link"]['active'], 3) }}">--}}
      {{--                        <i class="menu-icon {{ @$item['icon'] ?: 'la la-circle' }}"></i>--}}
      {{--                        <span class="menu-title">{{ __(@$item['name']) }}</span>--}}
      {{--                    </a>--}}
      {{--                    <div class="sidebar-submenu {{menuActive(@$item["link"]['active'],2)}} ">--}}
      {{--                        <ul>--}}
      {{--                            @foreach($item['children'] as $menu)--}}
      {{--                                @php $menu['icon'] = 'las la-dot-circle'; @endphp--}}
      {{--                                <x-admin::menu :item="$menu" :admin="@$admin"/>--}}
      {{--                            @endforeach--}}
      {{--                        </ul>--}}
      {{--                    </div>--}}
      {{--                </li>--}}
      {{--            @else--}}
      {{--                <li class="sidebar-menu-item {{ menuActive($item["link"]['active'], null, @$item["link"]['params']) }}">--}}
      {{--                    <a href="{{ isset($item["link"]['name']) ? route(@$item["link"]['name'], @$item["link"]['params']) : 'javascript:void(0)'}}"--}}
      {{--                       class="nav-link nav-item-{{titleToKey(@$item['name'])}}"--}}
      {{--                       @if(is_array(@$item['search']))--}}
      {{--                           data-search-query="{{ @$item['search']['query'] }}"--}}
      {{--                       data-search-title="{{ __(@$item['search']['title']) }}"--}}
      {{--                       @if(@$item['search']['group']) data-search-group="{{ @$item['search']['group'] }}" @endif--}}
      {{--                       @endif--}}
      {{--                       target="{{ @$item['target'] }}">--}}
      {{--                        <i class="menu-icon {{ @$item['icon'] ?: 'la la-circle' }}"></i>--}}
      {{--                        <span class="menu-title">{{ __(@$item['name']) }}</span>--}}
      {{--                    </a>--}}
      {{--                </li>--}}
      {{--            @endif--}}
    @endif
    @break
  @case('title')
    @if(isset($item['children']))
      <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">{{ __($item['name']) }}</span>
      </li>
    @endif
    @if(isset($item['children']))
      @foreach($item['children'] as $menu)
        <x-admin::menu :item="$menu" :admin="@$admin"/>
      @endforeach
    @endif
    @break
@endswitch