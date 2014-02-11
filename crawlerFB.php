<?php

error_reporting(0);

set_time_limit(100000);

include("header.php");
include("library/crawler/libs/PHPCrawler.class.php");

class MyCrawler extends PHPCrawler
{
    
    function handleDocumentInfo($DocInfo)
    {
        if (PHP_SAPI == "cli") $lb = "\n";
        else $lb = "<br>";
        echo "<tr>";
        echo "<td><a href=".$DocInfo -> url.">".$DocInfo -> url."</a></td>";
        echo "<td>".$DocInfo -> referer_url."</td>";
        echo "<td>".$DocInfo -> http_status_code."</td>";
        echo "</tr>";
        
        $file ="results/".$_REQUEST['file'].".txt";
        
        $konten = fopen($file,'a');
        
        $url = $DocInfo -> url;
        
		$info = file_get_contents('https://graph.facebook.com/comments/?ids='.$url);

		$yow = json_decode($info);

            if($yow){
                foreach ($yow->$url->comments->data as $value) {
                    $fcontent = $value->message;
                    fwrite($konten,$fcontent.PHP_EOL);
                }
            }
        flush();
    }    
}
?>

<div class="row">
	<div class="col-lg-12">
    	<h1><i class="fa fa-facebook-square"></i><small> Using Graph Facebook API</small></h1>
    </div>
    <div class="alert alert-info alert-disimssable">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	You may enter a website below
    </div>
</div>
<form role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="row">
	<div class="col-lg-12">
        <h2>API Setting</h2>
        <div class="col-xs-6">
    	    <div class="form-group">
                <fieldset>
                <legend>Basic Setting</legend>
        		<label>Website URL :</label>
            	<input class="form-control" placeholder="Ex: www.sysfotech.com" name="url" required="true"><br>
                <label>Follows Rule :</label>
                <input class="form-control" placeholder="Ex: #www.sysfotech.com/post#" name="rule"><br>
                <label>File Name:</label>
                <input class="form-control" placeholder="Ex: Data" name="file" required="true"><br>
                </fieldset>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <fieldset>
                <legend>Advanced Setting | Still In Observation</legend>
                <label>Filter Rule:</label>
                <select multiple class="form-control" disabled="true">
                	<option value="jpeg">JPEG</option>
                    <option value="gif">GIF</option>
                    <option value="css">CSS</option>
                    <option value="jpg">JPG</option>
                    <option value="png">PNG</option>
                    <option value="js">JS</option>
                    <option value="bmp">BMP</option>
                </select><br>
                <label>Content Type Received:</label>
                <select class="form-control" disabled="true">
                    <option value="#text/html#">default</option>
                	<option value="#text/html#">text/html</option>    
                </select>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 text-center">
         <div class="form-group">
               <button type="submit" name="proc" class="btn btn-primary" value="true">
               Start Crawling
               </button>
         </div>
    </div>
</div>
</form>
<div class="row">
	<div class="col-lg-12">
    	<h2>Crawling Result</h2>
        <div class="table-responsive">
        	<table class="table table-bordered table-hover table-striped tablesorter">
            	<thead>
                	<tr>
                    	<th>Page Requested<i class="fa fa-sort"></i></th>
                        <th>Page Referer<i class="fa fa-sort"></i></th>
                        <th>Http Status Code<i class="fa fa-sort"></i></th>
                    </tr>
                </thead>
                <?php
					if(!isset($_REQUEST['proc']))
                    {
                    }
                    else
                    {
                    $crawler = new MyCrawler();
                                                
                    $crawler -> setURL($_POST['url']);
                                         
                    $crawler -> addURLFollowRule($_POST['rule']);
                                          
                    $crawler -> addContentTypeReceiveRule("#text/html#");
                                          
                    $crawler -> addURLFilterRule("#(jpg|jpeg|gif|png|bmp)$# i");
                                           
                    $crawler -> addURLFilterRule("#(css|js)$# i");
                                         
                    $crawler -> enableCookieHandling(true);
                                            
                    $crawler -> setTrafficLimit(100000 * 1024);
                                            
                    $crawler -> go();
                    }
				?>
            </table>
        </div>
    </div>
</div>
<?php
include ("footer.php");
?>