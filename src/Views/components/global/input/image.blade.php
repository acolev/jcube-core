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
	"size" => 'xl',
])

@if($label)
  <div>
    <label class="@if(!!$required) required @endif" for="{{ $id }}">{!! __($label) !!}</label>
  </div>
@endif
<div class="position-relative d-inline-block">
  <div class="position-absolute top-100 start-100 translate-middle">
    <label for="{{ $id }}" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right"
           aria-label="Select Image" data-bs-original-title="{{ __('Select Image') }}">
      <div class="avatar-xs">
        <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
          <i class="ri-image-fill"></i>
        </div>
      </div>
    </label>
    <input class="d-none" type="file" name="{{ $name }}" value="" id="{{ $id }}" accept="image/png, image/gif, image/jpeg, .svg" onchange="previewImageInput(this, '#{{ $id }}-preview')">
  </div>
  <div class="avatar-{{ $size }}">
    <div class="avatar-title bg-{{ @$variants->bg ?: 'light' }} rounded  p-2">
      <img src="{{ storage_asset($value, @$variants->size) }}" id="{{ $id }}-preview" class="w-100 h-auto">
    </div>
  </div>
</div>

@pushonce('script')
  <script>
    function previewImageInput(input, target) {
      let file = input.files[0];
      let reader = new FileReader();

      reader.readAsDataURL(file);

      reader.onload = function () {
        document.querySelector(target).setAttribute('src', reader.result)
      };

      reader.onerror = function () {
        console.log(reader.error);
      };

    }
  </script>
@endpushonce
