@php
    $id = 'drawer-' . \Str::random(8)
@endphp
<div class="drawer" id="{{$id}}">
    <div class="drawer-container">
        <div class="drawer-backdrop" onclick="toggleDrawer('{{$id}}')"></div>
        <div class="drawer-aside">
            <div class="drawer-aside-close">
                <a href="javascript:void(0)" onclick="toggleDrawer('{{$id}}')">
                    <i class="la la-close fs-5"></i>
                </a>
            </div>
            {{ @$aside }}
        </div>
        <div class="drawer-content">
            <div class="drawer-content-title mb-5">
                <div class="d-flex align-items-center gap-3">
                    <div class="drawer-content-close">
                        <a href="javascript:void(0)" onclick="toggleDrawer('{{$id}}')">
                            <i class="las la-bars fs-5"></i>
                        </a>
                    </div>
                    <div @class(['flex-fill'])>{{ @$title }}</div>
                </div>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>

@pushonce('style-lib')
    <link rel="stylesheet" href="{{asset('admin_assets/css/components/drawer.css')}}">
@endpushonce

@push('script')
    <script>
      function toggleDrawer(id) {
        const el = document.querySelector('#' + id);
        el.classList.toggle('open');
      }
    </script>
@endpush