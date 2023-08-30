@props([
	'menus' => [],
	'noBody' => false
])
<div class="page-wrapper default-version">
    <x-admin::layout.part.sidenav :menus="$menus">
        @if(isset($mainMenu))
            <x-slot name="mainMenu">{{ $mainMenu }}</x-slot>
        @endif
        @if(isset($asidePre))
            <x-slot name="asidePre">{{ $asidePre }}</x-slot>
        @endif
        @if(isset($asidePost))
            <x-slot name="asidePost">{{ $asidePost }}</x-slot>
        @endif
        @if(isset($asideOverride))
            <x-slot name="asideOverride">{{ $asideOverride }}</x-slot>
        @endif
    </x-admin::layout.part.sidenav>
    <x-admin::layout.part.topnav>
        @if(isset($topBarLeft))
            <x-slot name="topBarLeft">{{ $topBarLeft }}</x-slot>
        @endif
        @if(isset($topBarRight))
            <x-slot name="topBarRight">{{ $topBarRight }}</x-slot>
        @endif
    </x-admin::layout.part.topnav>

    @if(@$noBody)
        <div class="body-wrapper p-0">
            {{ $slot }}
        </div>
    @else
        <div class="body-wrapper">
            <div class="bodywrapper__inner">

                <x-admin::layout.part.breadcrumb :page-title="$pageTitle"/>
                {{ $slot }}

            </div>
        </div>
    @endif
</div>