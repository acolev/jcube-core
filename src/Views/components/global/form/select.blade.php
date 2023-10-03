@props([
	"name" => '',
	"value" => '',
	"type" => 'string',
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"multiple" => false,
	"variants" => [],
])
@php
    $id = \Str::random(8)
@endphp

@if($label )
    <label class="@if(!!$required) required @endif">{{ __($label) }}</label>
@endif

<select @class(['form-control', 'select2-multi-select' => $multiple, 'select2-basic' => !$multiple]) @if($multiple) multiple @endif name="{{ $name }}"
        id="{{ $id }}" {{ $attributes }}>
    <option value="">{{ __($placeholder ?: 'Choose option') }}</option>
    @if(isset($variants))
        @foreach($variants as $v => $variant)
            @if($multiple)
                <option value="{{$v}}" @selected(in_array($v, $value))>{{ __($variant) }}</option>
            @else
                <option value="{{$v}}" @selected($value == $v)>{{ __($variant) }}</option>
            @endif
        @endforeach
    @endif
</select>
