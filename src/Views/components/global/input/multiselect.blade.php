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
	"search_placeholder" => '',
	"non_selected_header" => '',
	"selected_header" => '',
	"limit" => '-1',
])

<x-input type="select" multiple
         :label="$label"
         :name="$name"
         :placeholder="$placeholder"
         :value="$value"
         :required="$required"
         :id="$id"
         :variants="$variants" {{ $attributes }} />

@pushonce('style-lib')
  <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/libs/multi.js/multi.min.css') }}"/>
@endpushonce

@pushonce('script-lib')
  <script src="{{ asset('admin_assets/libs/multi.js/multi.min.js') }}"></script>
@endpushonce

@push('script')
  <script>
    function init_multi_{{ $id }} () {
      multi(document.getElementById("{{ $id }}"), {
        enable_search: @json($search),
        search_placeholder: @json($search_placeholder),
        non_selected_header: @json($non_selected_header),
        selected_header: @json($selected_header),
        limit_reached: function () {
          console.log(1)
        },
        hide_empty_groups: false,
        limit: @json($limit)
      });
    }
    init_multi_{{ $id }}();
  </script>
@endpush
