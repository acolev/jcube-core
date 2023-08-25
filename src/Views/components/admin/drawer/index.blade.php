<div class="drawer">
    <div class="drawer-backdrop"></div>
    <div class="drawer-container">
        <div class="drawer-aside">
            {{ @$aside }}
        </div>
        <div class="drawer-content">
            {{ $slot }}
        </div>
    </div>
</div>

@pushonce('style')
    <style>
        .drawer {
            --aside-width: 24rem;
            height: calc(100dvh - 74px);
        }

        .drawer-container {
            position: relative;
            height: inherit;
            padding-left: var(--aside-width);
        }

        .drawer-aside {
            position: absolute;
            top: 0;
            left: 0;
            width: 24rem;
            height: inherit;
            background: #fff;
        }

        .drawer-content {
            padding: 48px;
            height: inherit;
            overflow: auto;
        }
    </style>
@endpushonce