<?php

$newTitle = $_POST["title"];
$newPrice= $_POST["price"];
$image = $_FILES["image"]["name"];
$category = $_POST["category"];

$target = "./images/".basename($_FILES["image"]["name"]);

$connection = new mysqli("localhost","timohh97_admin1","449060data","timohh97_phpdata");

if(strlen($image)>0)
{
$query = "INSERT INTO shop (title,price,image,category) VALUES ('$newTitle','$newPrice','$image','$category')";

mysqli_query($connection,$query);


if(move_uploaded_file($_FILES["image"]["tmp_name"],$target))
{
    echo "<script>alert('Das neue Produkt wurde erfolgreich hinzugefügt!')</script>";
    echo "<script>window.location='..'</script>";
}

}
else
{
  $query = "INSERT INTO shop (title,price,image,category) VALUES ('$newTitle','$newPrice','error.jpg','$category')";

   mysqli_query($connection,$query);  
   
   echo "<script>alert('Das neue Produkt wurde erfolgreich hinzugefügt!')</script>";
    echo "<script>window.location='..'</script>";
}



?>