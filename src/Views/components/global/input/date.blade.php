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
	"format" => "d M, Y",
])

@if($label)
  <label class="@if(!!$required) required @endif" for="{{ $id }}">{{ __($label) }}</label>
@endif
<input type="text"
       class="form-control flatpickr-input"
       data-provider="flatpickr"
       data-date-format="{{ $format }}"
       name="{{ $name }}"
       value="{{ $value }}"
       placeholder="{{ $placeholder }}"
       id="{{ $id }}"
    @required($required)
    {{ $attributes }}
/>


@pushonce('style-lib')
  <link rel="stylesheet" href="{{ asset('admin_assets/libs/flatpickr/css/flatpickr.min.css') }}">
@endpushonce
@pushonce('script-lib')
  <script src="{{ asset('admin_assets/libs/flatpickr/flatpickr.min.js') }}"></script>
@endpushonce
@pushonce('script')
  <script>
    $(".flatpickr-input").flatpickr({});
  </script>
@endpushonce