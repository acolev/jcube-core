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
])

<div class="form-check form-switch">
  <input type="hidden" name="{{$name}}" value="0" data-fill="none">
  <input class="form-check-input"
         type="checkbox"
         role="switch"
         name="{{ $name }}"
         value="1" id="{{ $id }}"
      @required(!!$required)
      @checked(!!$value)
      {{ $attributes }}>
  @isset($label)
    <label for="{{ $id }}" class="@required(!!$required)">{{ __($label) }}</label>
  @endisset
</div>