<?php

error_reporting(0);

include('header.php');
function getDirectory($getdir)
{ 
    if ($handle = opendir($getdir)) 
    {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                echo "$entry";
                echo "<br>";
            }
        }
        closedir($handle);
   }
}
?>
<div class="row">
	<div class="col-lg-12">
    	<h1>Sentiment Analysis <small>Using Bayes Naive</small></h1>
        <div class="alert alert-info">
            Please Check library/dictionaries Setting before you Proceed to Push The "Processing Button" to prevent future error
        </div>
    </div>
</div>

<div class="row">

          <div class="col-lg-3">
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-6 text-right">
                        <p class="announcement-heading">Valid Tree</p>         
                      </div>
                  </div>
                </div>
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      source.ign.php
                    </div>
                  </div>
                    <div class="row">
                    <div class="col-xs-6">
                      source.neg.php
                    </div>
                  </div>
                    <div class="row">
                    <div class="col-xs-6">
                      source.neu.php
                    </div>
                  </div>
                    <div class="row">
                    <div class="col-xs-6">
                      source.pos.php
                    </div>
                  </div>
                    <div class="row">
                    <div class="col-xs-6">
                      source.prefix.php
                    </div>
                  </div>
                </div>
            </div>
          </div>
    
          <div class="col-lg-3">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">Your Tree</p>
                  </div>
                </div>
              </div>
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      <?php
						            getDirectory( "library/dictionaries" );
					            ?>
                    </div>
                  </div>
                </div>
            </div>
          </div>
    
    	  <div class="col-lg-3">
    		    <div class="alert alert-dismissable alert-info">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Just for your Information : </strong> In order to make the process go smooth without any error, 
                you have to make sure your tree is exactly the same as system. Unless you want to experience great error severe. 
            </div>
    	  </div>
</div>

<div class="row">
	<div class="col-lg-4">
        <form role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group">
            <label>Select Range Domain:</label>
            <select class="form-control" name="file">
              <?php
                  require_once("configuration/connect.php");

                  $sql = "select distinct domain from datadom";

                  $exec = mysql_query($sql);

                  while($r = mysql_fetch_array($exec)){
                    echo "<option value='".$r['domain']."'>$r[domain]</option>";
                  }
              ?>
            </select>
          </div>
          <br>
    	    <button type="submit" class="btn btn-primary" value="true" name="proc">Submit</button>
        </form>
    </div>
</div>
<br>
<div class="row">
	<div class="col-lg-12">
    	<h2>Classification Result</h2>
        <div class="table-responsive">
        	<table class="table table-bordered table-hover table-striped tablesorter">
            	<thead>
                	<tr>
                    	  <th>No.<i class="fa fa-sort"></i></th>
                        <th>Sentence<i class="fa fa-sort"></i></th>
                        <th>Category<i class="fa fa-sort"></i></th>
                  </tr>
              </thead>
              <tbody>
                <?php
                      if(!isset($_REQUEST['proc']))
                      {

                      }else
                      {
                        set_time_limit(3600);

                        include 'library/sentiment.class.php';
                        include 'configuration/connect.php';
                        
                        $sentiment = new Sentiment();

                        $no = 1;

                        $query = mysql_query("select no, article from datadom");

                              while($row = mysql_fetch_array($query))
                              {
                                  echo "<tr>";
                                  echo "<td>".$row['no']."</td>";
                                  $scores = $sentiment->score($row['article']);
                                  foreach ($scores as $class => $score) {
                                      $string = "$class -- <i>$score</i>";
                                      if ($class == $sentiment->categorise($row['article'])) {
                                          $string = "<b class=\"$class\">$string</b>";
                                          echo "<td>".$row['article']."</td>";
                                          if($class == "pos")
                                          {
                                           $sql = "update datadom set class='pos' where article='$row[no]'";
                                           //mysql_query($sql);
                                           $stat = "<span class='label label-success'>Positive</span>";
                                          }
                                          elseif($class =="neg")
                                          {
                                           $sql1 = "update datadom set class='neg' where article='$row[no]'";
                                           //mysql_query($sql1);
                                           $stat = "<span class='label label-danger'>Negative</span>";
                                          }
                                          else
                                          {
                                           $sql2 = "update datadom set class='neu' where article='$row[no]'";
                                           //mysql_query($sql2);
                                           $stat = "<span class='label label-default'>Neutral</span>";
                                          }
                                          echo "<td>".$stat."</td>";
                                      }
                                  }

                                  if(@!mysql_query($sql) or @!mysql_query($sql1) or @!mysql_query($sql2))
                                  {
                                    /*echo "<div class=modal fade>
                                          <div class=modal-dialog>
                                            <div class=modal-content>
                                              <div class=modal-header>
                                                <button type=button class=close data-dismiss=modal aria-hidden=true>&times;</button>
                                                <h4 class=modal-title>Error Happened !</h4>
                                              </div>
                                              <div class=modal-body>
                                                <p>This is a normal in scrapping. Sometimes error on scrapping may happen in the middle. Make sure you use fast connection and use valid url file</p>
                                                <hr>
                                                <p>Perhaps you want to scrap from the beginning ?</p>
                                              </div>
                                              <div class=modal-footer>
                                                <button type=button class=btn btn-default data-dismiss=modal>Close</button>
                                              </div>
                                            </div><!-- /.modal-content -->
                                          </div><!-- /.modal-dialog -->
                                          </div><!-- /.modal -->";*/
                                          echo "something error".mysql_errno().mysql_error()."<br>";
                                  }
                                  $no++;
                                  echo "</tr>";
                                  flush();
                              }
                     }
                  ?>
              </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div><!-- /.modal -->

<?php

include('footer.php');

?>