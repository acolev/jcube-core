(
  document.querySelectorAll("[toast-list]") ||
  document.querySelectorAll("[data-choices]") ||
  document.querySelectorAll("[data-provider]")) &&
(
  document.writeln("<cript type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'><\/cript>"),
    document.writeln("<script type='text/javascript' src='/admin_assets/libs/choices.js/public/assets/scripts/choices.min.js'><\/script>"),
    document.writeln("<script type='text/javascript' src='/admin_assets/libs/flatpickr/flatpickr.min.js'><\/script>")
);
