<?php

include('header.php');

function getDirectory( $path = '.', $level = 0 ){ 

    $ignore = array( 'cgi-bin', '.', '..' ); 
    // Directories to ignore when listing output. Many hosts 
    // will deny PHP access to the cgi-bin. 

    $dh = @opendir( $path ); 
    // Open the directory to the handle $dh 
     
    while( false !== ( $file = readdir( $dh ) ) ){ 
    // Loop through the directory 
     
        if( !in_array( $file, $ignore ) ){ 
        // Check that this file is not to be ignored 
             
            $spaces = str_repeat( '&nbsp;', ( $level * 4 ) ); 
            // Just to add spacing to the list, to better 
            // show the directory tree. 
             
            if( is_dir( "$path/$file" ) ){ 
            // Its a directory, so we need to keep reading down... 
             
                echo "<strong>$spaces $file</strong><br />"; 
                getDirectory( "$path/$file", ($level+1) ); 
                // Re-call this same function but on a new directory. 
                // this is what makes function recursive. 
             
            } else { 
             
                echo "$spaces $file<br />"; 
                // Just print out the filename 
             
            } 
         
        } 
     
    } 
     
    closedir( $dh ); 
    // Close the directory handle 

} 

?>
<script>
function process()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","library/function.php",true);
xmlhttp.send();
}
</script>

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
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">Right Tree</p>
                   
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
    
    	  <div class="col-lg-6">
    		<div class="alert alert-dismissable alert-info">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Just for your Information : </strong> In order to make the process go smooth without any error, 
                you have to make sure your tree is exactly the same as system. Unless you want to experience great error severe. 
            </div>
    	  </div>
</div>

<div class="row">
	<div class="col-lg-4">
    	<button class="btn btn-primary btn-lg" onclick="process()">Processing</button>
    </div>
</div>

<div class="row">
	<div class="col-lg-6">
    	<div id="myDiv"></div>
    </div>
</div>


<?php

include('footer.php');

?>

