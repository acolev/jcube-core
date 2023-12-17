@switch($layout)
  @case('detached')
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
          data-layout="vertical"
          data-layout-style="detached"
          data-layout-position="fixed"
          data-topbar="{{ $topbarColor ?: 'light' }}"
          data-sidebar="{{ $sidebarColor ?: 'dark' }}"
          data-sidebar-size="{{ $sidebarSize ?: 'lg' }}"
          data-sidebar-image="{{ $sidebarImage ?: 'none' }}"
          data-preloader="{{ $preloader ? "enable" : 'disable' }}"
          data-layout-width="{{ $layoutWidth  ?: 'fluid' }}"
    >
    @break
    @case('horizontal')
      <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
            data-layout="horizontal"
            data-layout-position="fixed"
            data-topbar="{{ $topbarColor ?: 'light' }}"
            data-sidebar="{{ $sidebarColor ?: 'dark' }}"
            data-sidebar-size="{{ $sidebarSize ?: 'lg' }}"
            data-sidebar-image="{{ $sidebarImage ?: 'none' }}"
            data-preloader="{{ $preloader ? "enable" : 'disable' }}"
            data-layout-width="{{ $layoutWidth  ?: 'fluid' }}"
      >
      @break
      @case('twocolumn')
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
              data-layout="twocolumn"
              data-layout-style="default"
              data-layout-position="fixed"
              data-topbar="{{ $topbarColor ?: 'light' }}"
              data-sidebar="{{ $sidebarColor ?: 'dark' }}"
              data-sidebar-size="{{ $sidebarSize ?: 'lg' }}"
              data-sidebar-image="{{ $sidebarImage ?: 'none' }}"
              data-preloader="{{ $preloader ? "enable" : 'disable' }}"
              data-layout-width="{{ $layoutWidth  ?: 'fluid' }}"
        >
        @break
        @case('semibox')
          <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
                data-layout="semibox"
                data-layout-style="default"
                data-layout-position="fixed"
                data-topbar="{{ $topbarColor ?: 'light' }}"
                data-sidebar="{{ $sidebarColor ?: 'dark' }}"
                data-sidebar-size="{{ $sidebarSize ?: 'lg' }}"
                data-sidebar-image="{{ $sidebarImage ?: 'none' }}"
                data-preloader="{{ $preloader ? "enable" : 'disable' }}"
                data-layout-width="{{ $layoutWidth  ?: 'fluid' }}"
          >
          @break
          @default
            <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
                  data-layout="vertical"
                  data-topbar="{{ $topbarColor ?: 'light' }}"
                  data-sidebar="{{ $sidebarColor ?: 'dark' }}"
                  data-sidebar-size="{{ $sidebarSize ?: 'lg' }}"
                  data-sidebar-image="{{ $sidebarImage ?: 'none' }}"
                  data-preloader="{{ $preloader ? "enable" : 'disable' }}"
                  data-layout-width="{{ $layoutWidth  ?: 'fluid' }}"
            >
    @break
@endswitch