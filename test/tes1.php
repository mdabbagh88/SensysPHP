<?php
	
	include("library/simplehtmldom/simple_html_dom.php");


	$url = "http://politik.news.viva.co.id/news/read/475320-kesalahan-pasek-di-mata-hayono-isman";

	$html = file_get_html($url);

	foreach ($html->find('div#content-left-details') as $o) {
		foreach ($o->find('div.content-details') as $e) {
			//foreach($e->find('div.isiberita') as $f){
				$item['article'] = $e->find('div.isiberita',0)->plaintext;
			//}
		}
	}
	echo $item['article'];
?>