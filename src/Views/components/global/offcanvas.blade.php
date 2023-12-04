@props([
  'id' => null,
  'pos' => 'end',
  'title' => '',
  'width' => null,
])
@isset($button)
    {{$button}}
@else
    <button class="btn btn--primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#{{ $id }}" role="button"
            aria-controls="{{ $id }}">
        <i class="la la-bars p-0"></i>
    </button>
@endisset

<div class="offcanvas offcanvas-{{$pos}}" tabindex="-1" id="{{ $id }}" aria-labelledby="{{ $id }}Label"
     @if($width) style="min-width: {{$width}}" @endif>
    <div class="offcanvas-header bg-light">
        @if($title)
            <h5 class="offcanvas-title" id="{{ $id }}Label">{{ __($title) }}</h5>
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        {{ $slot }}
    </div>
</div>
