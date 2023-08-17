<div class="page-wrapper default-version">
    <x-admin::layout.part.sidenav>
        {{ @$aside }}
    </x-admin::layout.part.sidenav>
    <x-admin::layout.part.topnav/>

    <div class="body-wrapper">
        <div class="bodywrapper__inner">

            <x-admin::layout.part.breadcrumb :page-title="$pageTitle"/>
            {{ $slot }}

        </div>
    </div>
</div>