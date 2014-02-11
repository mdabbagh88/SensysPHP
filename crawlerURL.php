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
        
        $file ="url/".$_REQUEST['file'].".csv";
        
        $konten = fopen($file,'a');
        
        if($DocInfo -> http_status_code != 200){

        }
        else
        {
            $host = parse_url($DocInfo->url,PHP_URL_HOST);
        	fputcsv($konten, array($DocInfo->url,$host));
        }

        echo "<tr>";
        echo "<td><a href=".$DocInfo -> url.">".$DocInfo -> url."</a></td>";
        echo "<td>".$DocInfo -> referer_url."</td>";
        echo "<td>".$DocInfo -> http_status_code."</td>";
        echo "</tr>";
        flush();
    }    
}
?>

<div class="row">
	<div class="col-lg-12">
    	<h1><i class="fa fa-facebook-square"></i><small> Crawling URL Site</small></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info alert-disimssable">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        	You may enter a website below
        </div>
    </div>
</div>
<form role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="row">
	<div class="col-lg-12">
        <h2>Crawl Setting</h2>
        <div class="col-xs-6">
    	    <div class="form-group">
                <fieldset>
                <legend>Basic Setting</legend>
        		<label>Website URL  <a href="#" id="tooltip" data-toggle="tooltip" title="click for hint !"><i class="fa fa-info-circle" data-toggle="modal" href="documentation/url/url.php" data-target="#myModal"></i></a></label>
            	<input class="form-control" placeholder="Ex: www.sysfotech.com" name="url" required="true"><br>
                <label>Follows Rule <a href="#" id="tooltip" data-toggle="tooltip" title="click for hint !"><i class="fa fa-info-circle" data-toggle="modal" href="documentation/url/follow.php" data-target="#myModal1"></i></a></label>
                <input class="form-control" placeholder="Ex: #www.sysfotech.com/post#" name="rule"><br>
                <label>File Name <a href="#" id="tooltip" data-toggle="tooltip" title="click for hint !"><i class="fa fa-info-circle" data-toggle="modal" href="documentation/url/file.php" data-target="#myModal2"></i></a></label>
                <input class="form-control" placeholder="Ex: Data" name="file" required="true"><br>
                </fieldset>
            </div>
        </div>
        <!--<div class="col-xs-6">
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
        </div>-->
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
                                                    
                        $crawler -> setURL($_REQUEST['url']);
                                             
                        $crawler -> addURLFollowRule($_REQUEST['rule']);
                                              
                        $crawler -> addContentTypeReceiveRule("#text/html#");
                                              
                        $crawler -> addURLFilterRule("#(jpg|jpeg|gif|png|bmp|css|js)$# i");
                                             
                        $crawler -> enableCookieHandling(true);

                        $crawler -> setFollowMode(3);

                        $crawler -> setFollowRedirects(TRUE);

                        $crawler -> setStreamTimeout(3000);

                        $crawler -> setConnectionTimeout(3000);

                        $crawler -> enableAggressiveLinkSearch(FALSE);
                                                
                        $crawler -> setTrafficLimit(100000 * 1024);
                                                
                        $crawler -> go();
                    }
				?>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<!-- /.modal -->
<?php
include ("footer.php");
?>