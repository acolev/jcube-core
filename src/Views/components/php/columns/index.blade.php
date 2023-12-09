@if($cols <= $max)
  <div class="row row-cols-md-{{$cols}}">
    {{ $slot }}
  </div>
@else
  <div>
    <ul class="arrow-navtabs bg-light mb-3 nav nav-pills nav-primary" id="{{ $id }}" role="tablist" {{ $attributes }}>
      @stack($columns)
    </ul>
  </div>
  <div class="content">
    <div class="tab-content" id="{{ $id }}">
      {{ $slot }}
    </div>
  </div>
@endif