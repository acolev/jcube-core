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
            plugins: 'preview case importcss searchreplace autolink autosave directionality visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
          toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor case removeformat help | pagebreak | charmap emoticons | fullscreen  preview | insertfile image media template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
          quickbars_selection_toolbar: 'bold italic underline strikethrough | quicklink h2 h3 blockquote | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | case',
          templates: [
            {title: 'Article', description: '', content: '<h2>Header 2</h2> <p>story</p>'},
          ],
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
        });
      })();

    </script>
@endpush
