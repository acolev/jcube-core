@props([
	"name" => '',
	"value" => '',
	"type" => 'string',
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"variants" => [],
	"id" => null,
	"search" => false,
])

@if($label)
  <label class="@if(!!$required) required @endif" for="{{ $id }}">{{ __($label) }}</label>
@endif
<x-input type="select" multiple="multiple" :id="$id" :variants="$variants" {{ $attributes }} />

@pushonce('style-lib')
  <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/libs/multi.js/multi.min.css') }}"/>
@endpushonce

@pushonce('script-lib')
  <script src="{{ asset('admin_assets/libs/multi.js/multi.min.js') }}"></script>
@endpushonce

@push('script')
  <script>
    multi( document.getElementById("{{ $id }}"), {
      enable_search: @json($search)
    });
  </script>
@endpush