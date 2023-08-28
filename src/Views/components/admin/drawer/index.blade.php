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

        .drawer-menu-title{
            margin: 2.5rem 2rem;
            font-size: 1.75rem;
            font-weight: 900;
        }

        .drawer-menu a {
            display: block;
            padding: 1.25rem 2rem;
            line-height: 1.5rem;
            border-bottom: 1px solid var(--bs-border-color);
        }

        .drawer-menu a:first-child {
            border-top: 1px solid var(--bs-border-color);
        }

        .drawer-menu b {
            font-size: .875rem;
            font-weight: 500;
            color: var(--bs-dark);
        }

        .drawer-menu p {
            font-size: .875rem;
            color: var(--bs-secondary);
        }

        .drawer-menu i {
            font-size: 24px;
            color: rgba(var(--bs-secondary-rgb), .7);
        }

        .drawer-menu a:hover {
            background-color: #f1f5f9;
        }

        .drawer-menu a.active {
            background-color: #eef2ff;
        }

        .drawer-menu a.active i,
        .drawer-menu a.active b {
            color: var(--bs-primary);
        }
    </style>
@endpushonce