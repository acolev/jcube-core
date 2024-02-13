@props([
	"name" => '',
	"value" => '',
	"type" => 'string',
	"auto" => false,
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"variants" => [],
	"id" => null,
	"simple" => false,
	"provider" => false,
	"multiple" => false,
])
@if($label)
  <label class="@if(!!$required) required @endif" for="{{ $id }}">{!! __($label) !!}</label>
@endif
<select class="form-control" @if($multiple) multiple @endif name="{{ $name }}"
        id="{{ $id }}" @required($required) {{ $attributes }}>
  @if($placeholder)
    <option value="">{{ __($placeholder) }}</option>
  @endif
  @if(isset($variants))
    @foreach($variants as $v => $variant)
      @if(@is_array($value))
        <option
            value="{{$v}}"@selected(@in_array($v, $value) || @in_array($variant, $value))>{{ __($variant) }}</option>
      @else
        <option value="{{ $simple ? $variant : $v}}" @selected($value == $v)>{{ __($variant) }}</option>
      @endif
    @endforeach
  @endif
</select>

@if($provider === 'select2')
  @push('script')
    <script>
      @switch($auto)
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
@elseif($provider === 'tom')
  @pushonce(@'style-lib')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
  @endpushonce
  @pushonce('script-lib')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
  @endpushonce
  @push('script')
    <script>
      new TomSelect("#{{$id}}", {
        @switch($auto)
            @case('auto')
        create: true,
        createOnBlur: true,
        @break
        @endswitch
      });
    </script>
  @endpush
@endif
