@push('styles-lib')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/iziToast/css/iziToast.min.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset('admin_assets/vendor/iziToast/js/iziToast.min.js') }}"></script>
@endpush

@push('script')
    @if(session()->has('notify'))
        @foreach(session('notify') as $k => $msg)
            <script>
              iziToast.{{ $msg[0] }}({message: "{{ __($msg[1]) }}", position: "topRight"});
            </script>
        @endforeach
    @endif

    @if (isset($errors) && $errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp

        <script>
          "use strict";
          @foreach ($errors as $error)
          iziToast.error({
            message: '{{ __($error) }}',
            position: "topRight"
          });
            @endforeach
        </script>

    @endif
    <script>
      "use strict";

      function notify(status, message) {
        iziToast[status]({
          message: message,
          position: "topRight"
        });
      }
    </script>
@endpush
