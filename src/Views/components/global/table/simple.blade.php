@props([
   "perPage" => null,
   "currentPage" => null,
   "dark" => null,
   "striped" => null,
   "responsive" => null,
   "items" => null,
   "fields" => null,
	 "type" => null,
	 "id" => null,
])
@php $fields = $fields ?: array_keys($items->first()->getAttributes()); @endphp

<div @class(['table-responsive' => $responsive])>
  <table class="table table-nowrap">
    <thead>
    <tr>
      @foreach($fields as $field)
        <th scope="row">{{ keyToTitle($field) }}</th>
      @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
      <tr>
        @foreach($fields as $field)
          <td>
            @php echo @$item->$field @endphp
          </td>
        @endforeach
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
