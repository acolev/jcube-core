@props([
	"name" => '',
	"value" => '',
	"type" => 'string',
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"variants" => [],
	"id" => null,
	"async" => null,
])

@if($label)
  <label class="@if(!!$required) required @endif" for="{{ $id }}">{!! __($label) !!}</label>
@endif
<input type="text"
       dir="ltr"
       spellcheck=false
       autocomplete="off"
       autocapitalize="off"
       id="{{ $id }}"
    @required($required)
    {{ $attributes }}/>

@pushonce('script-lib')
  <script src="{{ asset('admin_assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>
@endpushonce
@push('script')
  <script>
    (function () {
      new autoComplete({
        selector: "#{{ $id }}",
        placeHolder: "{{ $placeholder }}",
        data: {
          @if($async)
          src: async (query) => {
            try {
              const source = await fetch(`{{$async}}${query}`);
              const data = await source.json();
              return data;
            } catch (error) {
              return error;
            }
          },
          cache: true,
          @else
          src: @json($variants),
          @endif
        },
        resultItem: {
          highlight: true,
        }
      });
    })();
  </script>
@endpush