@props([
	"name" => '',
	"value" => '',
	"type" => 'multi-select',
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"multiple" => false,
	"maxItems" => false,
	"variants" => [],
])
@php
  $id = \Str::random(8)
@endphp

@if($label )
  <label class="@if(!!$required) required @endif">{{ __($label) }}</label>
@endif
<div>
  <select @class(['form-control']) @if($multiple) multiple @endif name="{{ $name }}" id="{{ $id }}" {{ $attributes }}>
    @if(!$multiple)
      <option value="">{{ __($placeholder ?: 'Choose option') }}</option>
    @endif
    @if(isset($variants))
      @foreach($variants as $v => $variant)
        @if($multiple)
          <option value="{{$v}}" @selected(@in_array($v, $value) || @in_array($variant, $value))>
            {{ __($variant) }}
          </option>
        @else
          <option value="{{$v}}" @selected($value == $v)>{{ __($variant) }}</option>
        @endif
      @endforeach
    @endif
  </select>
</div>
@push('script')
  <script>
    @switch($type)
    @case('auto')
      $("#{{$id}}").select2({
        tags: true,
        @if($maxItems)
        maximumSelectionLength: {{ $maxItems }}
            @endif
      });
    @break
    @default
      $("#{{$id}}").select2();
    @break
    @endswitch
  </script>
@endpush