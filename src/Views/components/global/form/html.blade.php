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
            plugins: 'preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons code',
          toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor casechange permanentpen removeformat | pagebreak | charmap emoticons | fullscreen  preview | image media template link anchor codesample | showcomments addcomment code',
          templates: [
            {title: 'Article', description: '', content: '<h2>Header 2</h2> <p>story</p>'},
          ],
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
