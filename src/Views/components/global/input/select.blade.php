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
	"simple" => false,
	"provider" => false,
	"multiple" => false,
])
@if($label)
  <label class="@if(!!$required) required @endif" for="{{ $id }}">{{ __($label) }}</label>
@endif
<select class="form-control" @if($multiple) multiple @endif name="{{ $name }}" id="{{ $id }}" {{ $attributes }}>
  @if($placeholder)
    <option value="">{{ __($placeholder) }}</option>
  @endif
  @if(isset($variants))
    @foreach($variants as $v => $variant)
      @if(@is_array($value))
        <option value="{{$v}}"@selected(@in_array($v, $value) || @in_array($variant, $value))>{{ __(keyToTitle($variant)) }}</option>
      @else
        <option value="{{ $simple ? $variant : $v}}" @selected($value == $v)>{{ __(keyToTitle($variant)) }}</option>
      @endif
    @endforeach
  @endif
</select>

@if($provider === 'select2')
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
@endif
