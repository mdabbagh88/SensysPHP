<?php 

include "header.php";
require_once "configuration/connect.php";

if(!isset($_REQUEST['post']))
{
	echo "<center><h4>Sorry Dude, You can't Access this Page without sending anything !</h4></center>";
}

$post=$_REQUEST['post'];

$sql = "select * from datadom where no='$post'";

$query = mysql_query($sql);

while($r=mysql_fetch_array($query)){
	echo "<div class=row>
			<div class=col-lg-12>
			  <div class=col-md-8>
				<h4>$r[title]</h4>
				<h6><a href='$r[url]'><small>$r[url]</small></a></h6>
				<hr>
				<blockquote>
					<p>
						$r[article]
					</p>
				</blockquote>
				<hr>
				Article Classification: 
				<blockquote>
					<p>$r[class]</p>
				</blockquote>
			  </div>
			  <div class=col-md-4>
			  	<div class=panel panel-danger>
			  		<div class=panel-heading><h3>IMPORTANT INFO</h3></div>
			  		<div class=panel-body>
			  			<ol>
							<li>This article is courtesy of $r[domain].</li>
							<li>It is forbidden to manipulate this article for another activity.</li>
							<li>It's recommended to read full of this article from the website directly. This result is just for a test.</li>
							<li>By reading this info, it means you agree to above statement</li>
			  			</ol>
			  		</div>
			  		<div class=panel-footer>
						courtesy of $r[domain]
			  		<div>
			  	</div>
			  </div>
			</div>
		  </div>
	";
}

include "footer.php"; ?>