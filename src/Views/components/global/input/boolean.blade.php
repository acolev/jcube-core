@props([
	"name" => null,
	"value" => null,
	"type" => null,
	"label" => null,
	"placeholder" => null,
	"required" => null,
	"btn" => null,
	"inline" => null,
	"variants" => null,
	"id" => null,
	"text" => null,
])
<div class="d-flex flex-wrap flex-sm-nowrap gap-5 justify-content-between align-items-center">
  <div>
    <p class="fw-bold mb-0">{{ __($label) }}</p>
    @isset($text)
      <div class="text--small text-muted">
        @php echo htmlspecialchars_decode($text) @endphp
      </div>
    @endisset
  </div>
  <div class="form-group">
    <x-form.input type="toggle" :name="$name" :value="$value"/>
  </div>
</div>