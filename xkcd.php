<?php
	$objXML = simplexml_load_file("http://xkcd.com/rss.xml");
//	var_dump($objXML);

	echo $objXML->channel->title . "<br>";
	echo $objXML->channel->link . "<br>";
	echo $objXML->channel->description . "<br>";
	foreach($objXML->channel->item as $item){
		echo $item->title . "<br>";
		echo $item->link . "<br>";
		echo $item->description . "<br>";
		echo $item->pubDate . "<br>";
		echo $item->guid . "<br>";
	}
?>