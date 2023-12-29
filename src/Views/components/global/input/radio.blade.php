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

<div class="form-check">
  <input class="form-check-input" type="radio" name="{{ $name }}" @required(!!$required) value="{{ $value }}"
         placeholder="{{ $placeholder }}" id="{{ $id }}" {{ $attributes }}>
  @if($label)
    <label class="form-check-label @if(!!$required) required @endif" for="{{ $id }}">{!! __($label) !!}</label>
  @endif
</div>