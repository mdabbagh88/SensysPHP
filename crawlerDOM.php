<?php

error_reporting(0);

set_time_limit(100000);

include("header.php");
include("configuration/connect.php");
include("library/simplehtmldom/simple_html_dom.php");


    function scrap()
    {
        include("configuration/connect.php");

        $file="results/datacsv/".$_REQUEST['file'];

        if(($handle = fopen("url/".$_REQUEST['file'],'r')) !== FALSE)
        {
            $konten = fopen($file, 'a');
            while(($data = fgetcsv($handle, 30000, ",")) !== FALSE){
                $num = count($data);
                for($c = 0;$c < 1; $c++)
                {
                    $html = file_get_html($data[0]);

                    foreach($html->find($_REQUEST['filetitle']) as $a){
                        $item['title'] = trim($a -> find('h1',0)->plaintext);
                    }

                    foreach($html->find($_REQUEST['filearticle']) as $o){
                        $item['article'] = trim($o -> find('p',0)->plaintext);
                    }

                    $sql = "insert into datadom(url,domain,title,article) value('$data[0]','$data[1]','$item[title]','$item[article]')";

                    if(!mysql_query($sql)){
                        echo "<div class=row>
                                <div class=col-lg-12 text-center>
                                    <h3><b>Somethin' Error Dude</b></h3>
                                </div>
                              </div>
                             ";
                    }

                    fputcsv($konten, array($data[0],$data[1],$item['title'],$item['article']));

                    echo "<tr>";
                    echo "<td>".$data[0]."</td>";
                    echo "<td>".$item['title']."</td>";
                    echo "<td>".$item['article']."</td>";
                    echo "</tr>";

                    flush();
                }
            }
            fclose($handle);
        }else
        {
            echo "<div class=row>
                    <div class=col-lg-12 text-center>
                        <h3><b>Somethin' Error Dude</b></h3>
                    </div>
                  </div>
                 ";
        }
    }    
?>

<div class="row">
	<div class="col-lg-12">
    	<h1><i class="fa fa-html5"></i> <small> Using DOM HTML Parser</small></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info alert-disimssable">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        	You have to know DOM usage first check here : <a href="http://www.w3schools.com/js/js_htmldom.asp">DOM in W3schools</a>
        </div>
    </div>
</div>
<form role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="row">
	<div class="col-lg-12">
        <h2>DOM Setting</h2>
        <div class="col-xs-6">
    	    <div class="form-group">
                <fieldset>
                <legend>Basic Setting</legend>
        		<label>Crawled URL File: <a href="#" id="tooltip" data-toggle="tooltip" title="click for hint !"><i class="fa fa-info-circle" data-toggle="modal" href="documentation/scrap/url.php" data-target="#myModal"></i></a></label>
                <select class="form-control" name="file">
                    <?php
                        if($handle = opendir("url/"))
                        {
                            while(false !== ($entry = readdir($handle))){
                                if($entry != "." && $entry != ".."){
                                    echo "<option value=$entry>$entry</option>";
                                }
                            }
                                closedir($handle);
                        }
                    ?>
                </select><br>
                <label>DOM element:</label><br>
                Title Element
                <a href="#" id="tooltip" data-toggle="tooltip" title="click for hint !"><i class="fa fa-info-circle" data-toggle="modal" href="documentation/scrap/title.php" data-target="#myModal1"></i></a>
                <input class="form-control" placeholder="Ex: viva : div#content, republika : div.content-detail-center, merdeka : div#mdk-body-nd" name="filetitle" required="true"><br>
                Article Element
                <a href="#" id="tooltip" data-toggle="tooltip" title="click for hint !"><i class="fa fa-info-circle" data-toggle="modal" href="documentation/scrap/article.php" data-target="#myModal2"></i></a>
                <input class="form-control" placeholder="Ex: viva : div#content, republika : div.content-detail-center, merdeka : div#mdk-body-nd" name="filearticle" required="true"><br>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 text-center">
         <div class="form-group">
               <button type="submit" name="proc" class="btn btn-primary" value="true">
               Start Scrapping
               </button>
         </div>
    </div>
</div>
</form>
<div class="row">
	<div class="col-lg-12">
    	<h2>Scrapping Result</h2>
        <div class="table-responsive">
        	<table class="table table-bordered table-hover table-striped tablesorter">
            	<thead>
                	<tr>
                    	<th>Scrapped URL<i class="fa fa-sort"></i></th>
                        <th>Article Title<i class="fa fa-sort"></i></th>
                        <th>Article Content<i class="fa fa-sort"></i></th>
                    </tr>
                </thead>
                <?php
					if(!isset($_REQUEST['proc']))
                    {
                    }
                    else
                    {
                        scrap();
                    }
				?>
            </table>
        </div>
    </div>
</div>
<!--Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<?php
include ("footer.php");
?>