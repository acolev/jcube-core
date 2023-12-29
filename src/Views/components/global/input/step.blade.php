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
	"min" => 0,
	"max" => 100,
	"color" => null,
	"full" => null,
])

@if($label)
  <label class="@if(!!$required) required @endif" for="{{ $id }}">{!! __($label) !!}</label>
@endif
<div>
  <div @class(['input-step', 'step-'.$color => $color, 'full-width' => $full])>
    <button type="button" class="minus">–</button>
    <input type="number" class="product-quantity"
           name="{{ $name }}"
           value="{{ $value }}"
           min="{{ $min }}"
           max="{{ $max }}"
           readonly
           id="{{ $id }}"
        @required($required)
        {{ $attributes }}>
    <button type="button" class="plus">+</button>
  </div>
</div>

@pushonce('script')
  <script>
    function isData() {
      let t = document.getElementsByClassName("plus");
      let e = document.getElementsByClassName("minus");
      let n = document.getElementsByClassName("product");
      t && Array.from(t).forEach(function (t) {
        t.addEventListener("click", function (e) {
          parseInt(t.previousElementSibling.value) < e.target.previousElementSibling.getAttribute("max") && (e.target.previousElementSibling.value++, n) && Array.from(n).forEach(function (t) {
            updateQuantity(e.target)
          })
        })
      });
      e && Array.from(e).forEach(function (t) {
        t.addEventListener("click", function (e) {
          parseInt(t.nextElementSibling.value) > e.target.nextElementSibling.getAttribute("min") && (e.target.nextElementSibling.value--, n) && Array.from(n).forEach(function (t) {
            updateQuantity(e.target)
          })
        })
      })
    }

    isData();
  </script>
@endpushonce