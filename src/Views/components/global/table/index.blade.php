@props([
   "perPage" => 20,
   "currentPage" => 1,
   "dark" => false,
   "striped" => false,
   "responsive" => true,
   "items" => [],
   "fields" => null,

	"type" => 'simple',
	"id" => genTrx(6, 'qwertyuiopasdfghjklzxcvbnm'),
])

@if(View::exists('components.input.' . strtolower($type)) || file_exists($global_components_path . 'input/'. strtolower($type) . '.blade.php'))
  @php $componentName = 'table.' . strtolower($type); @endphp
  @php $notExists = false; @endphp
@else
  @php $componentName = 'table.simple'; @endphp
  @php $notExists = true; @endphp
@endif

<x-dynamic-component :component="$componentName"
                     :perPage="$perPage"
                     :currentPage="$currentPage"
                     :dark="$dark"
                     :striped="$striped"
                     :responsive="$responsive"
                     :items="$items"
                     :fields="$fields"
                     :type="$type"
                     :id="$id"
                     :attributes="$attributes">

  @isset($cell)
    <x-slot name="cell">{{$cell}}</x-slot>
  @endisset
</x-dynamic-component>
