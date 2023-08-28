@props([
	"name" => null,
	"label" => null,
	"value" => null,
	"variants" => null,
	"default" => null,
	"type" => 'string',
	"text" => null,
])

@switch($type)
    @case('string')
        <x-form.input :name="$name" :label="$label" :value="$value ?: $default"/>
        @break
    @case('text')
        <x-form.input type="text" :name="$name" :label="$label" :value="$value ?: $default"/>
        @break
    @case('html')
        <x-form.html :name="$name" :label="$label" :value="$value ?: $default"/>
        @break
    @case('code')
        <x-form.code :name="$name" :label="$label" :value="$value ?: $default"/>
        @break
    @case('boolean')
        <div class="d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
            <div>
                <p class="fw-bold mb-0">{{ __($label) }}</p>
                @isset($text)
                    <div class="text--small text-muted">
                        @php echo $text @endphp
                    </div>
                @endisset
            </div>
            <div class="form-group">
                <input type="hidden"  name="{{$name}}" value="off">
                <input
                        type="checkbox"
                        data-width="80"
                        data-height="24"
                        data-size="small"
                        data-onstyle="-success"
                        data-offstyle="-danger"
                        data-bs-toggle="toggle"
                        data-on="@lang('Enable')"
                        data-off="@lang('Disable')"
                        name="{{$name}}"
                        @checked($value == 1)>
            </div>
        </div>
        @break
    @case('json')
        @break
    @default
        <div class="alert alert-danger">
            <div class="alert__message">
                {{ __('The field type :type does not have form component ', ['type' => $type]) }}
            </div>
        </div>
        @break
@endswitch