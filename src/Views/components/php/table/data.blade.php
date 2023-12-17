<table @class([
        'table',
         'table-nowrap' => $nowrap,
          'table-striped' => $striped,
          'table-striped-columns' => $stripedColumns,
          'table-dark' => $dark,
          'table-hover' => $hover,
          ]) id="{{ $id }}"
       data-page-length='{{ $perPage }}'
       data-display-start='{{ $page - 1 }}'
>
  @if($header)
    <thead @class(['table-light' => !$dark])>
    <tr>
      @foreach($fields as $field)
        @if(isset(${"head_" . $field}))
          <th scope="row" {{ ${"head_" . $field}->attributes }}>{{ ${"head_" . $field} }}</th>
        @else
          <th scope="row">{{ __(keyToTitle($field)) }} </th>
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

@pushonce('style-lib')
  <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css"/>
  <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
        type="text/css"/>
@endpushonce
@pushonce('script-lib')
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
@endpushonce

@pushonce('script')
  <script>
    (function () {
      const table = new DataTable('#{{ $id }}', {
        scrollY: "210px",
        scrollCollapse: !0,
        paging: true,
        responsive: @json($responsive),
        columnDefs: [
          {actions: 1, targets: 0},
          {responsivePriority: 2, targets: -1}
        ],
      });

      table.on('page.dt', function () {
        var info = table.page.info();
        const url = new URL(location.href);
        url.searchParams.set('page', info.page + 1);
        history.pushState(null, '', url.href)
      });

    })();
  </script>
@endpushonce