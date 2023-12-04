@props([
	'menu' => [],
	'noBody' => false
])
<div id="layout-wrapper">
  <x-admin::layout.part.header>
          @if(isset($headerLeft))
            <x-slot name="headerLeft">{{ $headerLeft }}</x-slot>
          @endif
          @if(isset($headerRight))
            <x-slot name="headerRight">{{ $headerRight }}</x-slot>
          @endif
  </x-admin::layout.part.header>
  @if(count($menu))
    <x-admin::layout.part.appMenu :menu="$menu"/>
  @endif

  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">
        {{ $slot }}
      </div>

    </div>
    <x-admin::layout.part.footer/>
  </div>
</div>
