@props([
	"item" => [],
	"admin" => [],
])

@switch($item["link"]['type'])
    @case('link')
        <li class="sidebar-menu-item {{ @$item['children'] ? 'sidebar-dropdown' : '' }} {{menuActive($item["link"]['active'])}}">
            @if(isset($item['children']))
                <a href="javascript:void(0)" class="nav-link ">
                    <i class="menu-icon {{ @$item['icon'] ?: 'la la-circle' }}"></i>
                    <span class="menu-title">{{ __($item['name']) }}</span>
                </a>
                <div class="sidebar-submenu">
                    <ul>
                        @foreach($item['children'] as $menu)
                            <x-admin::menu :item="$menu" :admin="$admin"/>
                        @endforeach
                    </ul>
                </div>
            @else
                <a href="{{route($item["link"]['name'], @$item["link"]['params'])}}" class="nav-link"
                   target="{{ @$item['target'] }}">
                    <i class="menu-icon {{ @$item['icon'] ?: 'la la-circle' }}"></i>
                    <span class="menu-title">{{ __($item['name']) }}</span>
                </a>
            @endif
        </li>
        @break
    @case('title')
        <div data-header="{{ __($item['name']) }}" class="sidebar__menu-section">
            @if(isset($item['children']))
                @foreach($item['children'] as $menu)
                    @if(isset($menu['access']))
                        @if($admin->access($menu['access']))
                            <x-admin::menu :item="$menu" :admin="$admin"/>
                        @endif
                    @else
                        <x-admin::menu :item="$menu" :admin="$admin"/>
                    @endif
                @endforeach
            @endif
        </div>
        @break
@endswitch