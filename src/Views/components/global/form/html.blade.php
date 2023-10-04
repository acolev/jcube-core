@props([
	"name" => '',
	"value" => '',
	"label" => "",
	"required" => false,
	"type" => 'full',
	"menubar" => 'false',
	"templates" => [],
])
@php
    $id = \Str::random(8)
@endphp

@if($label)
    <label class="@if(!!$required) required @endif">{{ __($label) }}</label>
@endif
<textarea class="tinymce" name="{{ $name }}">{{ $value }}</textarea>

@push('script-lib')
    <script src="{{asset('admin_assets/vendor/tinymce/tinymce.min.js')}}"></script>
@endpush
@push('script')
    <script>
      (function () {
        tinymce.init({
          selector: '.tinymce',
          statusbar: false,
          menubar: {{ $menubar }},
            @if($type == 'full')
            plugins: 'preview case importcss searchreplace autolink autosave directionality visualblocks visualchars fullscreen image link media template codesample table charmap  nonbreaking anchor insertdatetime advlist lists wordcount charmap quickbars emoticons code',
          toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor case removeformat | charmap emoticons | insertfile image media link anchor codesample | a11ycheck ltr rtl | showcomments addcomment | fullscreen  preview  code',
          quickbars_selection_toolbar: 'bold italic underline strikethrough | quicklink h2 h3 blockquote | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | case',
          quickbars_insert_toolbar: 'template image table',
          templates: @json($templates),
          toolbar_mode: 'sliding',
          autosave_ask_before_unload: true,
          autosave_interval: '30s',
          autosave_prefix: '{path}{query}-{id}-',
          autosave_restore_when_empty: false,
          autosave_retention: '2m',
            @else
            plugins: 'lists autoresize',
          toolbar: 'bold italic h2 h3 numlist bullist blockquote hr undo redo',
            @endif
            autoresize: 'on',
          images_upload_url: '/api/images/editor',
          image_title: true,
          relative_urls: false,
          remove_script_host: false,
          convert_urls: false,
          images_upload_base_path: '/'
        });
      })
      ();
    </script>
@endpush
