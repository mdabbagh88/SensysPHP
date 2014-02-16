<?php
    include ("header.php");

?>

<div class="row">
	<div class="col-lg-12">
    	<h1>Home<small> Latest Update!</small></h1>
    </div>
</div>
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    You have 1.2 Beta Version ! You can browse SensysPHP version <a class="alert-link" href="http://github.com/endrureza/sensysphp/"><i class="fa fa-github-alt"></i>Github</a>{Feel Free to use this on your project}
</div>
<form role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <div class="form-group">
                <fieldset>
                    <legend><h3>SensysPHP</h3></legend>
                    <input class="form-control" name="q" required="true" placeholder="Search Here"><br>
                    <button type="submit" class="btn btn-primary">Generate</button>
                    <button name="hint" class="btn btn-default">Hint !</button>
                </fieldset>
            </div>
        </div>
    </div>
</form>
<hr>
<?php

    if(!isset($_GET['q']))
    {

    }else
    {
        if(isset($_GET["page"])){ $page = $_GET["page"];}else{$page=1;};
        include ("configuration/connect.php");

        $start_from = ($page-1) * 50;
        $q = $_GET['q'];

        $query = "select * from datadom where article like '%$q%' order by no asc limit $start_from, 50";
        $sql = mysql_query($query);
        $check = mysql_fetch_row($sql);

        if($check == 0){
            echo "<center><h4>Sorry Dude, I've no idea what you're searching</h4></center>";
        }else{

        while($r=mysql_fetch_array($sql)){
            echo "<h5><a href='".$r['url']."'>".$r['url']."</a></h5>";
            echo "<h3><small>Main domain: </small></h3>".$r['domain'];
            echo "<blockquote><p><small>".substr($r['article'], 0, 400)."</small><a href='article.php?post=$r[no]'><code>Read More</code></a></p></blockquote><br>";
        }

        $count = mysql_query("select count(article) from datadom where article like '%q%'");
        $total_count = mysql_fetch_row($count);
        $total_records = $total_count[0];
        $total_pages = ceil($total_records / 50);

        echo "<hr><center><ul class=pagination>";
        for($i=1;$i<=$total_pages;$i++)
        {
            echo "<li><a href='index.php?q=$q&page=".$i."''>".$i."</a></li>";
        }
        echo "</ul></center>";
        }

        mysql_close();
    }
?>

<?php
    include ("footer.php");
?>
