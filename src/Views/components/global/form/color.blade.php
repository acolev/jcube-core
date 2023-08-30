@props([
	"name" => '',
	"value" => '',
	"lang" => 'css',
	"required" => false,
	"label" => '',
])
@php
    $id = \Str::random(8)
@endphp

<label for="{{ $id }}" class="@if(!!$required) required @endif">{{ __($label) }}</label>
<div class="input-group">
    <span class="input-group-text p-0 border-0">
        <input type='text' class="form-control colorPicker"
               value="{{ $value }}"/>
    </span>
    <input type="text" class="form-control colorCode" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" @required(!!$required)/>
</div>

@pushonce('style-lib')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/spectrum/spectrum.css') }}">
@endpushonce


@pushonce('script-lib')
    <script src="{{ asset('admin_assets/vendor/spectrum/spectrum.js') }}"></script>
@endpushonce

@pushonce('script')
    <script>
      (function ($) {
        "use strict";
        $('.colorPicker').spectrum({
          color: $(this).data('color'),
          change: function (color) {
            $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
          }
        });

        $('.colorCode').on('input', function () {
          var clr = $(this).val();
          $(this).parents('.input-group').find('.colorPicker').spectrum({
            color: clr,
          });
        });

        $('select[name=timezone]').val("'{{ config('app.timezone') }}'").select2();
        $('.select2-basic').select2({
          dropdownParent:$('.card-body')
        });
      })(jQuery);

    </script>
@endpushonce
