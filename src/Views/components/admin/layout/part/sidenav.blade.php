@php $admin = auth()->guard('admin')->user(); @endphp
@props([
	'menus' => []
])

<div class="sidebar">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        @if(isset($asideOverride))
            {{ $asideOverride }}
        @else
            <div class="sidebar__logo">
                <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img
                            src="{{getImage(getFilePath('logoIcon') .'/logo_dark.png')}}" alt="@lang('image')"></a>
            </div>
            <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
                {{ @$asidePre }}
                <ul class="sidebar__menu">
                    @foreach($menus as $menu)
                        <x-admin::menu :item="$menu" :admin="$admin"/>
                    @endforeach
                    {{ @$mainMenu }}
                </ul>
                {{ @$asidePost }}
            </div>
        @endif
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
      if ($('li').hasClass('active')) {
        $('#sidebar__menuWrapper').animate({
          scrollTop: eval($(".active").offset().top - 320)
        }, 500);
      }
    </script>
@endpush
