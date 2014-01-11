<?php

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

<!--<div class="row">
    
          <div class="col-lg-6">
            <fieldset>
              <legend>Basic Data Setting</legend>
              <div class="form-group">
                <label>Your Dictionary</label>
                <input type="file" name="data">
              </div>
            </fieldset>
          </div>

</div>!-->

<div class="row">

          <div class="col-lg-3 text-center">
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
        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group">
            <label>Select File:</label>
            <select class="form-control" name="file">
              <?php
                  if ($handle = opendir("results")) 
                  {
                      while (false !== ($entry = readdir($handle))) {
                          if ($entry != "." && $entry != "..") {
                              echo "<option value=$entry>$entry</option>";
                          }
                      }
                      closedir($handle);
                  }
              ?>
            </select>
          </div>
          <br>
    	    <input type="submit" class="btn btn-primary" value="Process" name="submit">
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
                    set_time_limit(3600);
					          if(!isset($_POST['submit']))
                    {
                    }
					          else
                    {
                        include 'library/sentiment.class.php';
                        
                        $sentiment = new Sentiment();
                        
                        $file = $_REQUEST['file'];
                        $examples = file("results/".$file);
                        
                        $no = 1;

                                foreach ($examples as $key) {
                                    echo "<tr>";
                                    echo "<td>".$no."</td>";
                                    $scores = $sentiment->score($key);
                                    foreach ($scores as $class => $score) {
                                        $string = "$class -- <i>$score</i>";
                                        if ($class == $sentiment->categorise($key)) {
                                            $string = "<b class=\"$class\">$string</b>";
                                            echo "<td>".$key."</td>";
                                            if($class == "pos")
                                            {
                                             $stat = "<span class='label label-success'>Positive</span>";
                                            }
                                            elseif($class =="neg")
                                            {
                                             $stat = "<span class='label label-danger'>Negative</span>";
                                            }
                                            else
                                            {
                                             $stat = "<span class='label label-default'>Neutral</span>";
                                            }
                                            echo "<td>".$stat."</td>";
                                        }
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


<?php

include('footer.php');

?>