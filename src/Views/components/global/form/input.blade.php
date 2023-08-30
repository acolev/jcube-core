@props([
	"name" => '',
	"value" => '',
	"type" => 'string',
	"label" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"variants" => [],
])
@php
    $id = \Str::random(8)
@endphp

@if($type === 'string')
    <label for="{{ $id }}" class="@required(!!$required)">{{ __($label) }}</label>
    <input class="form-control" type="text" name="{{ $name }}" @required(!!$required) value="{{ $value }}"
           id="{{ $id }}">
@elseif($type === 'number')
    <label for="{{ $id }}" class="@required(!!$required)">{{ __($label) }}</label>
    <input class="form-control" type="number" name="{{ $name }}" @required(!!$required) value="{{ $value }}"
           id="{{ $id }}">
@elseif($type === 'text')
    <label for="{{ $id }}" class="@required(!!$required)">{{ __($label) }}</label>
    <textarea {{ $attributes }} class="form-control" name="{{ $name }}" @if(!!$required) required
              @endif id="{{ $id }}">@php echo $value @endphp</textarea>
@elseif($type === 'toggle')
    <div class="form-check form-switch">
        <input type="hidden" name="{{$name}}" value="0">
        <input class="form-check-input"
               type="checkbox"
               role="switch"
               name="{{ $name }}"
               value="1" id="{{ $id }}"
                @required(!!$required)
                @checked(!!$value)>
        @isset($label)
            <label for="{{ $id }}" class="@required(!!$required)">{{ __($label) }}</label>
        @endisset
    </div>
@elseif(in_array($type, ['radio', 'checkbox']))
    <label class="@if(!!$required) required @endif">{{ __($label) }}</label>
    @if(is_array($variants))
        @php  if($type === 'checkbox') $name = $name. '[]' @endphp
        @if($btn)
            <div class="btn-group">
                @foreach($variants as $k=>$variant)
                    @php
                        if($type === 'radio')  $checked =  $value === $variant;
                        else $checked = in_array($variant, json_decode($value));
                    @endphp
                    <input @class(['btn-check' => $btn]) type="{{$type}}" name="{{ $name }}" value="{{ $variant }}"
                           id="{{ $id }}-{{ $k }}"  @checked($checked) @required(!!$required)>
                    <label class="btn btn-outline-primary" for="{{ $id }}-{{ $k }}">{{ __($variant) }}</label>
                @endforeach
            </div>
        @else
            @foreach($variants as $k=>$variant)
                @php
                    if($type === 'radio')  $checked =  $value === $variant;
                    else $checked = in_array($variant, json_decode($value));
                @endphp
                <div @class(['form-check-inline' =>  $inline,])>
                    <input @class(['form-check-input']) type="{{$type}}" name="{{ $name }}" value="{{ $variant }}"
                           id="{{ $id }}-{{ $k }}" @checked($checked) @required(!!$required)>
                    <label @class(['form-check-label']) for="{{ $id }}-{{ $k }}">
                        {{ __($variant) }}
                    </label>
                </div>
            @endforeach
        @endif
    @endif
@elseif($type === 'select')
    <label class="@if(!!$required) required @endif">{{ __($label) }}</label>
    @if(is_array($variants))
        <select class="form-control" name="{{ $name }}" id="{{ $id }}">
            <option value="">{{ __('Choose option') }}</option>
            @foreach($variants as $variant)
                <option value="{{$variant}}" @selected($value === $variant)>{{ __($variant) }}</option>
            @endforeach
        </select>
    @endif
@endif
