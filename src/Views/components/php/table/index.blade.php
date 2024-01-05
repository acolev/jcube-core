<div @class(['table-responsive' => $responsive, 'table-card' => $card])>
  <table @class([
        'table',
         'table-nowrap' => $nowrap,
          'table-striped' => $striped,
          'table-striped-columns' => $stripedColumns,
          'table-dark' => $dark,
          'table-hover' => $hover,
          ])>
    @if($header)
      <thead @class(['table-light' => !$dark])>
      <tr>
        @foreach($fields as  $key=>$field)
          @if(isset(${"head_" . $field}))
            <th scope="row" {{ ${"head_" . $field}->attributes }}>{!! ${"head_" . $field} !!}</th>
          @elseif(isset(${"head_" . $key}))
            <th scope="row" {{ ${"head_" . $key}->attributes }}>{!! ${"head_" . $key} !!}</th>
          @else
            <th scope="row">{!! __(keyToTitle($field)) !!} </th>
          @endif
        @endforeach
      </tr>
      </thead>
    @endif
    <tbody>
    {{ $slot }}
    </tbody>
    @if($footer)
      <tfoot>
      <tr>
        @foreach($fields as $field)
          @if(isset(${"head_" . $field}))
            <th scope="row" {{ ${"head_" . $field}->attributes }}>{{ ${"head_" . $field} }}</th>
          @else
            <th scope="row">{{ __(keyToTitle($field)) }} </th>
          @endif
        @endforeach
      </tr>
      </tfoot>
    @endif
  </table>
</div>
