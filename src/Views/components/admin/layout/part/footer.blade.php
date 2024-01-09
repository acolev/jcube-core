<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <script>document.write(new Date().getFullYear())</script>
        © {{__(gs()->site_name ?: env('APP_NAME'))}}.
      </div>
      <div class="col-sm-6">
        <div class="text-sm-end d-none d-sm-block">
          @php echo env('APP_COPYRIGHT') @endphp
        </div>
      </div>
    </div>
  </div>
</footer>