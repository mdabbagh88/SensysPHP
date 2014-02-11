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
        include ("configuration/connect.php");
        $q = $_GET['q'];

        $query = "select * from datadom where article like '%$q%' limit 10";
        $sql = mysql_query($query);
        $check = mysql_fetch_row($sql);

        if($check == 0){
            echo "<center><h4>Sorry Dude, I've no idea what you're searching</h4></center>";
        }

        while($r=mysql_fetch_array($sql)){
            echo "<h3><b>URL : </b></h3><a href='".$r['url']."'>".$r['url']."</a><br>";
            echo "<h3><small>Main domain: </small></h3>".$r['domain']."<br>";
            echo "<blockquote><p><small>".substr($r['article'], 0, 400)."</small></p></blockquote><br>";
        }

        mysql_close();
    }
?>

<?php
    include ("footer.php");
?>
