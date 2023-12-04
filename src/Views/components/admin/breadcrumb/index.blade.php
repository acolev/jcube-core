@props([
  'pageTitle'
])
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0">{{ __(@$pageTitle) }}</h4>

      <div class="page-title-right">
       {{ $slot }}
      </div>

    </div>
  </div>
</div>