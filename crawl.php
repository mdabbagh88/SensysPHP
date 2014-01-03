<?php

set_time_limit(100000);

include ("header.php");
include ("library/simple_html_dom.php");
require ("library/html2text.php");
include ("library/crawler/libs/PHPCrawler.class.php");

class MyCrawler extends PHPCrawler
{
    
    function handleDocumentInfo($DocInfo)
    {
        if (PHP_SAPI == "cli") $lb = "\n";
        else $lb = "<br>";
        echo "<tr>";
        echo "<td>".$DocInfo -> url."</td>";
        echo "<td>".$DocInfo -> referer_url."</td>";
        echo "<td>".$DocInfo -> http_status_code."</td>";
        echo "</tr>";
        
        $file ="Data.txt";
        
        $konten = fopen($file,'a');
        
        $url = $DocInfo -> url;
        
		$info = file_get_contents('https://graph.facebook.com/comments/?ids='.$url);

		$yow = json_decode($info);

            if($yow){
                foreach ($yow->$url->comments->data as $value) {
            
                    echo $value->message;
                    
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
    	<h1>Crawling<small> by typing a website</small></h1>
    </div>
    <div class="alert alert-info alert-disimssable">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	You may enter a website below
    </div>
</div>

<div class="row">
	<div class="col-lg-6">
    	<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
        		<label>Website URL :</label>
            	<input class="form-control" placeholder="Ex: www.sysfotech.com" name="url" required="true"><br>
                <label>Follows Rule :</label>
                <input class="form-control" placeholder="Ex: #www.sysfotech.com/post#" name="rule"><br>
                <button type="submit" name="submit" class="btn btn-default">
                Start Crawling
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row">
	<div class="col-lg-12">
    	<h2>Your data Will be written on the table below</h2>
        <div class="table-responsive">
        	<table class="table table-boardered table-hover table-striped tablesorter">
            	<thead>
                	<tr>
                    	<th>Page Requested</th>
                        <th>Page Referer</th>
                        <th>Http Status Code</th>
                    </tr>
                    <?php
			if(!isset($_POST['submit']))
			{
                    
                    	}else
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
                </thead>
            </table>
        </div>
    </div>
</div>
<?php
    include ("footer.php");
?>
