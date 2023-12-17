@props([
	'menu' => [],
	'noBody' => false,
	'search' => false,
])
<x-admin::layout.part.header :menu="$menu" :search="$search">
  @isset($headerLeft)
    <x-slot name="headerLeft">{{ $headerLeft }}</x-slot>
  @endisset
  @isset($headerRight)
    <x-slot name="headerRight">{{ $headerRight }}</x-slot>
  @endisset
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
