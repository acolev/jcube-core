@props(['class' =>null])

<div class="modal fade zoomIn" id="confirmationModal" tabindex="-1" aria-labelledby="deleteRecordLabel"
     style="display: none;" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
      </div>
      <div class="modal-body p-5 text-center">
        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                   colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
        <div class="mt-4 text-center">
          <h4 class="fs-semibold question"></h4>
          <div class="hstack gap-2 justify-content-center remove">
            <form action="" method="POST">
              @csrf
              <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" data-bs-dismiss="modal">
                <i class="ri-close-line me-1 align-middle"></i> {{ __('Close') }}
              </button>
              <button class="btn btn-danger" id="delete-record">{{ __('Yes, Delete It!!') }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('script')
  <script>
    (function () {
      "use strict";
      $(document).on('click', '.confirmationBtn', function (e) {
        e.preventDefault()
        var modal = $('#confirmationModal');
        let data = $(this).data();
        modal.find('.question').text(`${data.question}`);
        modal.find('form').attr('action', `${data.action}`);
        modal.modal('show');
      });
    })();
  </script>
@endpush
