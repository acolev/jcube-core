@if(@$fields)
  <tr {{ $attributes }}>
    @foreach($fields as $key=>$field)
      @if(isset(${"cell_" . $field}))
        <td {{ ${"cell_" . $field}->attributes }}>{{ ${"cell_" . $field} }}</td>
      @else
        <td>@php echo @$cols->$field ?:  @$cols->$key @endphp</td>
      @endif
    @endforeach
  </tr>
@endif
