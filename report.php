<?php
    include ("header.php");
    include ("configuration/connect.php");
?>

<div class="row">
	<div class="col-lg-12">
    	<h1>Report<small> Last Analysis</small></h1>
    </div>
</div>

<div class="row">
	<div class="col-lg-12">
    	<div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        	   This is a page where there will be a process generating a report of entered object across all articles
        </div>
    </div>
</div>

<form role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
        <div class="form-group">
          <fieldset>
            <legend>Input Object</legend>
            <h5>Article In Database: 
              <small>    
              <?php
                $kueri = "select count(article) from datadom";

                $sql = mysql_query($kueri);

                while($row=mysql_fetch_assoc($sql)){
                  echo $row['count(article)'];
                }
              ?>
              </small>
            </h5>
            <input type="text" class="form-control" name="object" required="true" data-role="tagsinput" placeholder="Type Enter after writing an Object to Seperate each Object"><br>
            <button type="submit" name="proc" class="btn btn-primary" value="true">Generate</button>
            <button name="hint" class="btn btn-default">Hint !</button>
          </fieldset>
        </div>
      </div>
  </div>
</form>
<hr>

<?php

  if(!isset($_REQUEST['proc']))
  {

  }
  else
  {

    $people = $_REQUEST['object'];

    $person = explode(',', $people);

    $max = count($person);

    for($i=0;$i < $max; $i++){

      $query = "select count(article) from datadom where article like '%$person[$i]%'";

      $query1 = "select count(article) from datadom where article like '%$person[$i]%' and class='pos'";

      $query2 = "select count(article) from datadom where article like '%$person[$i]%' and class='neg'";

      $que = mysql_query($query);

      $que1 = mysql_query($query1);

      $que2 = mysql_query($query2);

      while($r = mysql_fetch_assoc($que)){
        $dataset[] = array('label'=>$person[$i],'value'=>$r['count(article)']);
      }

      while($ro = mysql_fetch_assoc($que1)){
        $dataset1[] = array('x'=>$person[$i],'y'=>$ro['count(article)']);
      }

      while($ri = mysql_fetch_assoc($que2)){
        $dataset2[] = array('y'=>$person[$i],'a'=>$ri['count(article)']);
      }
    }
  }

?>
<div class="row">
  <div class="col-lg-12 text-center">
    <h5>How often appeared in articles?</h5>
    <small>Below: </small>
    <div id="donut"></div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-lg-12 text-center">
    <h5>Among Positive Article</h5>
    <small>Below: </small>
    <div id="bar-pos"></div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-lg-12 text-center">
    <h5>Among Negative Article</h5>
    <small>Below: </small>
    <div id="bar-neg"></div>
  </div>
</div>
<hr>
<script>
var dataset= <?php echo json_encode($dataset); ?>;
Morris.Donut({
  element: 'donut',
  data: dataset,
  backgroundColor: '#ccc',
  labelColor: '#060',
  colors: [
    '#0BA462',
    '#39B580',
    '#67C69D',
    '#95D7BB'
  ]
})
</script>
<script>
  var dataset1= <?php echo json_encode($dataset1); ?>;
  Morris.Bar({
    element: 'bar-pos',
    data: dataset1,
    xkey: 'x',
    ykeys: ['y'],
    labels: ['article']
  });
</script>
<script>
  var dataset2= <?php echo json_encode($dataset2); ?>;
  Morris.Bar({
    element: 'bar-neg',
    data: dataset2,
    xkey: 'y',
    ykeys: ['a'],
    labels: ['article']
  });
</script>
<?php
    include ("footer.php");
?>