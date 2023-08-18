<div class="page-wrapper default-version">
    <x-admin::layout.part.sidenav>
        @if(isset($mainMenu))
            <x-slot name="mainMenu">{{ $mainMenu }}</x-slot>
        @endif
        @if(isset($asidePre))
            <x-slot name="asidePre">{{ $asidePre }}</x-slot>
        @endif
        @if(isset($asidePost))
            <x-slot name="asidePost">{{ $asidePost }}</x-slot>
        @endif
    </x-admin::layout.part.sidenav>
    <x-admin::layout.part.topnav/>

    <div class="body-wrapper">
        <div class="bodywrapper__inner">

            <x-admin::layout.part.breadcrumb :page-title="$pageTitle"/>
            {{ $slot }}

        </div>
    </div>
</div>