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
    <input class="form-control" type="text" name="{{ $name }}" @if(!!$required) required @endif value="{{ $value }}"
           id="{{ $id }}">
@endif

@if($type === 'text')
    <label for="{{ $id }}" class="@if(!!$required) required @endif">{{ __($label) }}</label>
    <textarea {{ $attributes }} class="form-control" name="{{ $name }}" @if(!!$required) required
              @endif id="{{ $id }}">@php echo $value @endphp</textarea>
@endif

@if($type === 'toggle')
    <div class="form-check form-switch">
        <input type="hidden" name="{{$name}}" value="0">
        <input class="form-check-input"
               type="checkbox"
               role="switch"
               name="{{ $name }}"
               @if(!!$required) required @endif
               value="1" id="{{ $id }}"
                @checked(!!$value)>
        @isset($label)
            <label for="{{ $id }}" class="@if(!!$required) required @endif">{{ __($label) }}</label>
        @endisset
    </div>
@endif

