
    <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?=date("Y")?> <a href="http://abmegypt.net/" target="_blank">ABMEgypt</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-alpha
    </div>
  </footer>
  

  <?php
    if (isset($template['footer'])) {
      foreach($template['footer'] as $val) {
        echo $val;
      }
    }
  ?>

  <?php
    if (isset($template['script'])) {
      foreach($template['script'] as $val) {
        echo $val;
      }
    }
  ?>

    <!-- modal1 -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">

      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
        </div>

      </div>
    </div>
    <!-- END modal1 -->

    <!-- result modal -->
    <div class="modal fade" id="result-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
        </div>

      </div>
    </div>
    <!-- END result modal -->

</body>
</html>