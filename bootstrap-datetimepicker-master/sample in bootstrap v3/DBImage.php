<?php
	ini_set('mysql.connect_timeout', 300);
	ini_set('default_sockey_timeout',300);
?>

<html>
<body>
<script >

	function myFunction() {
	//console.log('event',event.target.getAttribute("image_id"));
	
}
</script>


<form method="post" enctype="multipart/form-data"><br>
	<input type="file" name="image" /><br><br>
	<input type="submit" name="submit" value="upload">
</form>

</body>
</html>

<?php

	$GLOBALS['items'] = array();
	$GLOBALS['getId'] = array();
	$GLOBALS['i'] = 0;

	if (isset($_POST['submit'])) {
		if (getimagesize($_FILES['image']['tmp_name'])== FALSE) {
			echo "Please select an image";
		}
		else{
			$image = addslashes($_FILES['image']['tmp_name']);
			$name =addslashes($_FILES['image']['name']);
			$image = file_get_contents($image);
			$image = base64_encode($image);
			saveimage($name,$image);

		}
	}
	
	function saveimage($name,$image)
	{	

		$con=mysqli_connect("localhost","Rahul","Koqa313*@3");
		mysqli_select_db($con,"testing");
		$qry="insert into images values (NULL,'$name','$image',NULL);";
		
		$result = mysqli_query($con,$qry);
		if ($result == true) {

			echo "<br>Image uploaded";
		}
		else{
			echo "<br>Image not uploaded";	
		}

	}

	displayimage();

		function displayimage(){
		$con=mysqli_connect("localhost","Rahul","Koqa313*@3");
		mysqli_select_db($con,"testing");
		$qry = "select * from images ";
		$result = mysqli_query($con,$qry);
 		
		
		
		while ($row = mysqli_fetch_array($result)) {
			echo '<img height ="300" width ="300" src="data:image/jpg;base64,' .$row[2]. ' "  >';
			//$GLOBALS['image_id'] = $row['image_id'];
			$items[$i] = $row['image_id'];
			echo "<form method = 'POST' action = '' >";
			echo ' <input type ="submit" name = "getId[$i]" value = "Click to book"> ';
			echo "</form>";
			$i++;
			//displayImageId($image_id);
		}
	
	if (isset($_POST['getId[$i]'])) {
		
		displayImageId($items[$i]);
		
	}

	function displayImageId($array)
	{
		echo $items[$i];

	}

		mysqli_close($con);
	}
	


?>


