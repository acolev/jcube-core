@props([
    'class' => '',
    'pos' => 'centered',
    'id',
    'title' => '',
    'noClose' => false
])
<div @class([$class, 'modal fade']) id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label"
     aria-hidden="true" {{$attributes}}>
  <div @class(['modal-dialog','modal-dialog-' .$pos])>
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
        @if(!$noClose)
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
        @endif
      </div>

      {{$slot}}

    </div>
  </div>
</div>
