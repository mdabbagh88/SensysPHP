<?php

//error_reporting(0);

set_time_limit(100000);

include("library/simplehtmldom/simple_html_dom.php");

	$row = 1;
	if (($handle = fopen("url/merdeka.csv", "r")) !== FALSE) {
		$handle1 = fopen("url/merdeka_title1.csv",'a');
	    while (($data = fgetcsv($handle, 30000, ",")) !== FALSE) {
	        $num = count($data);
	        echo "<p> $num fields in line $row: <br /></p>\n";
	        $row++;
	        for ($c=0; $c < $num; $c++) {

	            $html = file_get_html($data[$c]);

	            foreach ($html ->find('div#mdk-body-news') as $a) {

	            	$item['title'] = trim($a -> find('h1',0)->plaintext);

	            	foreach ($a -> find('div#mdk-body-newsarea') as $o) {
	            		$item['article'] = trim($o->find('p',0)->plaintext);
	            	}
	            	
	            }

	            fputcsv($handle1, array($item['title'],$item['article']));

	            echo $item['title']."<br>";
	            echo $item['article']."<br>";
	            echo "<hr>";

	            flush();
	        }
	    }
	    fclose($handle);
	}else{
		echo "What The FUCK ! neither you have such file or the file has no STRING at all -_-";
	}

?>