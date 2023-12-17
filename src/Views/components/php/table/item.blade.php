
@if(@$fields)
  <tr {{ $attributes }}>
    @foreach($fields as $field)
        @if(isset(${"cell_" . $field}))
        <td {{ ${"cell_" . $field}->attributes }}>{{ ${"cell_" . $field} }}</td>
        @else
          <td>{{ @$cols->$field }}</td>
        @endif
    @endforeach
  </tr>
@endif