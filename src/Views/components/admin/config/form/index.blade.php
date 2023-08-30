@props([
	"name" => null,
	"label" => null,
	"value" => null,
	"variants" => null,
	"default" => null,
	"type" => 'string',
	"text" => null,
])

@if(in_array($type, [
	'string',
	'number',
	'select',
	'text',
	'checkbox',
	'radio',
	'hidden',
]))
    <x-form.input :type="$type" btn :name="$name" :label="$label" :value="$value ?: $default"
                  :variants="explode(',', $variants)"/>
@elseif($type === 'html')
    <x-form.html :name="$name" :label="$label" :value="$value ?: $default"/>
@elseif($type === 'code')
    <x-form.code :name="$name" :label="$label" :value="$value ?: $default"/>
@elseif($type === 'boolean')
    <div class="d-flex flex-wrap flex-sm-nowrap gap-5 justify-content-between align-items-center">
        <div>
            <p class="fw-bold mb-0">{{ __($label) }}</p>
            @isset($text)
                <div class="text--small text-muted">
                    @php echo $text @endphp
                </div>
            @endisset
        </div>
        <div class="form-group">
            <x-form.input type="toggle" :name="$name" :value="$value ?: $default"/>
        </div>
    </div>
@elseif($type === 'color')
    <x-form.color :name="$name" :label="$label" :value="$value ?: $default"/>
@else
    @if(View::exists('components.form.'.$type))
        <x-dynamic-component :component="'form.'.$type"
                             :name="$name"
                             :label="$label"
                             :value="$value ?: $default"
                             :variants="explode(',', $variants)"/>
    @else
        <div class="alert alert-danger">
            <div class="alert__message">
                {{ __('The field type :type does not have form component ', ['type' => $type]) }}
            </div>
        </div>
    @endif
@endif