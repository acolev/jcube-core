@props([
  'id' => null,
  'pos' => 'end',
  'title' => '',
  'width' => null,
])
<div class="offcanvas offcanvas-{{$pos}}" tabindex="-1" id="{{ $id }}" aria-labelledby="{{ $id }}Label"
     @if($width) style="width: {{$width}}" @endif>
    <div class="offcanvas-header">
        @if($title)
            <h5 class="offcanvas-title" id="{{ $id }}Label">{{ __($title) }}</h5>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        {{ $slot }}
    </div>
</div>