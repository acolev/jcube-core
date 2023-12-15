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
	"id" => genTrx(6, 'qwertyuiopasdfghjklzxcvbnm'),
])

@if(View::exists('components.input.' . strtolower($type)) || file_exists($global_components_path . 'input/'. strtolower($type) . '.blade.php'))
  @php $componentName = 'input.' . strtolower($type); @endphp
  @php $notExists = false; @endphp
@else
  @php $componentName = 'input.text'; @endphp
  @php $notExists = true; @endphp
@endif

<x-dynamic-component :component="$componentName"
                     :name="$name"
                     :value="$value"
                     :type="$type"
                     :label="$label"
                     :placeholder="$placeholder ? __($placeholder) : null"
                     :required="$required"
                     :variants="$variants"
                     :id="$id"
                     :attributes="$attributes"/>
@if($notExists)
  <div class="text-danger p-2">
    {{ __('The field type ":type" does not have form component ', ['type' => $type]) }}
  </div>
@endif