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
	"lang" => 'html',
])

@if($label)
  <label class="@if(!!$required) required @endif" for="{{ $id }}">{{ __($label) }}</label>
@endif
<textarea class="codemirror" name="{{ $name }}" id="{{$id}}" {{ $attributes }}>@php echo $value @endphp</textarea>

@pushonce('style-lib')
    <link rel="stylesheet" href="{{asset('admin_assets/libs/codemirror/css/codemirror.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/libs/codemirror/css/monokai.min.css')}}">
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
    <script src="{{asset('admin_assets/libs/codemirror/js/codemirror.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/codemirror/js/css.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/codemirror/js/sublime.min.js')}}"></script>
@endpushonce

@pushonce('script')
    <script>
      "use strict";
      document.querySelectorAll(".codemirror").forEach(function (el) {
        var editor = CodeMirror.fromTextArea(el, {
          lineNumbers: true,
          mode: "text/{{ $lang }}",
          theme: "monokai",
          keyMap: "sublime",
          autoCloseBrackets: true,
          matchBrackets: true,
          showCursorWhenSelecting: true,
        });
      })
    </script>
@endpushonce
