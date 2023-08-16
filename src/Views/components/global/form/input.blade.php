@props([
	"name" => '',
	"value" => '',
	"type" => 'string',
	"label" => "",
	"required" => false,
])
@php
   $id = \Str::random(8)
@endphp

@if($type === 'string')
    <label for="{{ $id }}" class="@if(!!$required) required @endif">{{ __($label) }}</label>
    <input class="form-control" type="text" name="{{ $name }}" @if(!!$required) required @endif value="{{ $value }}" id="{{ $id }}">
@endif

@if($type === 'text')
    <label for="{{ $id }}" class="@if(!!$required) required @endif">{{ __($label) }}</label>
    <textarea {{ $attributes }} class="form-control" name="{{ $name }}" @if(!!$required) required @endif id="{{ $id }}">@php echo $value @endphp</textarea>
@endif

