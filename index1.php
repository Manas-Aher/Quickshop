<?php

    include('db.php');
    if(isset($_GET["name"]))
{
  $name= $_GET["name"];
}
?>

<!DOCTYPE html>
<html>
  <head>
	<title>Welcome Home</title>
    <link rel="stylesheet" href="sty.css">
  </head>
  <body>
    <div class="gin">
        <h1></h1>
        <a href="../index.php">Back to Shooping</a></br>
        <a href="login.php">Logout</a>
      <button><?php echo $_GET['name']; ?></button>
    </div>
  </body>
</html>