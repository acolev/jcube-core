@props([
	"name" => '',
	"value" => '',
	"label" => "",
	"required" => false,
	"type" => 'full',
	"menubar" => 'false',
])
@php
    $id = \Str::random(8)
@endphp

<textarea class="tinymce" name="{{ $name }}">{{ $value }}</textarea>

@push('script-lib')
    <script src="{{asset('admin_assets/vendor/tinymce/tinymce.min.js')}}"></script>
@endpush
@push('script-lib')
    <script>
      (function () {
        tinymce.init({
          selector: '.tinymce',
          statusbar: false,
          menubar: {{ $menubar }},
          @if($type == 'full')
            plugins: 'table image lists autoresize code',
            toolbar1: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | indent outdent | wordcount | image',
            toolbar2: 'code',
          @else
            plugins: 'lists autoresize',
            toolbar: 'bold italic h2 h3 numlist bullist blockquote hr undo redo',
          @endif
          autoresize: 'on',
          images_upload_url: '/api/images/editor',
        });
      })();

    </script>
@endpush
