@if($cols <= $max)
  <div class="row row-cols-md-{{$cols}}">
    {{ $slot }}
  </div>
@else
  <div>
    <ul class="nav nav-tabs nav-primary" id="{{ $id }}" role="tablist" {{ $attributes }}>
      @stack($columns)
    </ul>
  </div>
  <div class="content">
    <div class="tab-content" id="{{ $id }}">
      {{ $slot }}
    </div>
  </div>
@endif