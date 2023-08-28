@props([
	"item" => [],
	"admin" => null,
])
@switch($item["link"]['type'])
    @case('link')
        @if((!isset($item["link"]['name']) || Route::has($item["link"]['name'])) && (!isset($item['access']) || @$admin?->access($item['access'])) )
            @if(isset($item['children']))
                <li class="sidebar-menu-item {{ @$item['children'] ? 'sidebar-dropdown' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ menuActive($item["link"]['active'], 3) }}">
                        <i class="menu-icon {{ @$item['icon'] ?: 'la la-circle' }}"></i>
                        <span class="menu-title">{{ __($item['name']) }}</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive($item["link"]['active'],2)}} ">
                        <ul>
                            @foreach($item['children'] as $menu)
                                @php $menu['icon'] = 'las la-dot-circle'; @endphp
                                <x-admin::menu :item="$menu" :admin="@$admin"/>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @else
                <li class="sidebar-menu-item {{ menuActive($item["link"]['active']) }}">
                    <a href="{{route($item["link"]['name'], @$item["link"]['params'])}}" class="nav-link"
                       @if(is_array(@$item['search']))
                           data-search-query="{{ @$item['search']['query'] }}"
                       data-search-title="{{ __(@$item['search']['title']) }}"
                       @if(@$item['search']['group']) data-search-group="{{ @$item['search']['group'] }}" @endif
                       @endif
                       target="{{ @$item['target'] }}">
                        <i class="menu-icon {{ @$item['icon'] ?: 'la la-circle' }}"></i>
                        <span class="menu-title">{{ __($item['name']) }}</span>
                    </a>
                </li>
            @endif
        @endif
        @break
    @case('title')
        <div data-header="{{ __($item['name']) }}" class="sidebar__menu-section">
            @if(isset($item['children']))
                @foreach($item['children'] as $menu)
                    <x-admin::menu :item="$menu" :admin="@$admin"/>
                @endforeach
            @endif
        </div>
        @break
@endswitch