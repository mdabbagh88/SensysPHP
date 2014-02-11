<?php include "../header.php"; ?>

<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">How to set Follow Rule</h4>
      </div>
      <div class="modal-body">
        <h3>What is follow rule?</h3>
        <blockquote>
          <p>It's another set to crawl specific path within a root path</p>
        </blockquote>
        <h3>Basic Usage</h3>
        If You want to crawl content within path <strong><small>http://www.merdeka.com/politik</small></strong> and only crawl path containing <strong><small>politik</small></strong> only , simply use <b><small>politik</small></b><br>

        <h3>Using Reguler Expression</h3>
        if you want to crawl path and only taking url with html extension you may use regular expression like <b><small>(htm|html)</small></b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

<?php include "../footer.php"; ?>