@props([
	"name" => '',
	"value" => '',
	"type" => 'string',
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"variants" => [],
	"id" => null,
])

@if($label)
  <label class="@if(!!$required) required @endif" for="{{ $id }}">{{ __($label) }}</label>
@endif
<textarea class="codemirror" name="{{ $name }}" id="{{$id}}" {{ $attributes }}>@php echo $value @endphp</textarea>

@pushonce('style-lib')
  <link rel="stylesheet" href="http://esironal.github.io/cmtouch/lib/codemirror.css">
  <link rel="stylesheet" href="https://codemirror.net/5/theme/material.css">
@endpushonce
@pushonce('style')
  <style>
      .CodeMirror {
          border-top: 1px solid #eee;
          border-bottom: 1px solid #eee;
          line-height: 1.3;
          height: 500px;
      }

      .CodeMirror-linenumbers {
          padding: 0 8px;
      }

      .custom-css p, .custom-css li, .custom-css span {
          color: white;
      }

      .cm-s-monokai span.cm-tag {
          margin-left: 15px;
      }
  </style>
@endpushonce

@pushonce('script-lib')
  <script src="http://esironal.github.io/cmtouch/lib/codemirror.js"></script>
  <script src="http://esironal.github.io/cmtouch/mode/css/css.js"></script>
  <script src="http://esironal.github.io/cmtouch/mode/xml/xml.js"></script>
@endpushonce

@pushonce('script')
  <script>
    document.querySelectorAll(".codemirror").forEach(function (el) {
      CodeMirror.fromTextArea(el, {
        lineNumbers: true,
        theme: 'material',
        autoCloseBrackets: true,
        matchBrackets: true,
        showCursorWhenSelecting: true,
      });
    });
  </script>
@endpushonce
