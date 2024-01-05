@if(@$fields)
  <tr {{ $attributes }}>
    @foreach($fields as $key=>$field)
      @if(isset(${"cell_" . $field}))
        <td {{ ${"cell_" . $field}->attributes }}>{!! ${"cell_" . $field} !!}</td>
      @elseif(isset(${"cell_" . $key}))
        <td {{ ${"cell_" . $key}->attributes }}>{!! ${"cell_" . $key} !!}</td>
      @else
        <td>{!! @$cols->$field ?:  @$cols->$key !!}</td>
      @endif
    @endforeach
  </tr>
@endif
