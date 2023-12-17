@props([
	"value" => null,
	"default" => null,
])

<x-input :value="$value ?: $default" {{ $attributes }}/>
