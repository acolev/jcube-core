@php $admin = auth()->guard('admin')->user(); @endphp
@php $menus = config('adminMenu') @endphp

<div class="sidebar">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img
                        src="{{getImage(getFilePath('logoIcon') .'/logo_dark.png')}}" alt="@lang('image')"></a>
        </div>
        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
               @foreach($menus as $menu)
                   @if(isset($menu['access']))
                        @if($admin->access($menu['access']))
                            <x-admin::menu :item="$menu" :admin="$admin"/>
                        @endif
                   @else
                        <x-admin::menu :item="$menu" :admin="$admin"/>
                   @endif
               @endforeach
            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">{{__(systemDetails()['name'])}}</span>
                <span class="text--success">@lang('V'){{systemDetails()['version']}} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
      if($('li').hasClass('active')){
        $('#sidebar__menuWrapper').animate({
          scrollTop: eval($(".active").offset().top - 320)
        },500);
      }
    </script>
@endpush
