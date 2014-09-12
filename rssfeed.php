<html>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<style>
		<!--
		body{
			background-color: white;
		}
		-->
	</style>
<body>
	<form action="rssfeed.php" method="post">
		<fieldset>
			<legend>Feed</legend>
			<table>
				<tr>
					<td>Please enter the address of the rss feed:</td>
					<td><input type="text" name="feed_adr"></td>
				</tr>
			</table>
			<p><input type="submit" value="Submit">
			<input type="reset" name="Reset"></p>
		</fieldset>
	</form>


<?php
	if (isset($_POST['feed_adr'])){
		$objXML = simplexml_load_file($_POST['feed_adr']);
//		var_dump($objXML);
		echo $objXML->channel->title . "<br>";
		echo $objXML->channel->link . "<br>";
		echo $objXML->channel->description . "<br>";
		foreach($objXML->channel->item as $item){
			echo "<p>";
			echo $item->title . "<br>";
			echo $item->pubDate . "<br>";
			echo $item->image . "<br>";
			echo $item->description . "<br>";
			echo $item->link . "</p>";
		}
	}
?>

</body>
</html>