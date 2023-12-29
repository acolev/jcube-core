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

@if($label)
  <label class="@if(!!$required) required @endif" for="{{ $id }}">{!! __($label) !!}</label>
@endif
<textarea class="code-eвitor form-control" rows="10" name="{{ $name }}" id="{{$id}}" {{ $attributes }}>@php echo $value @endphp</textarea>

