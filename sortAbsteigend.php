<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head><meta charset="euc-jp">
        
        <title>Timo Schessl Shop</title>
        <link rel="stylesheet" href="searchStyle.css">
        
    </head>
    <body>
        <div id="categories">
            <form action="categoryButton.php" method="post">
                <?php
                $connection = new mysqli("localhost","timohh97_admin1","449060data","timohh97_phpdata");
        
                $query = "SELECT DISTINCT category FROM shop";
        
                $result = mysqli_query($connection,$query);
        
                while($row= mysqli_fetch_row($result))
               {
                   echo "<input id='categoryButton' type='submit' value='".$row[0]."' name='categoryButton'><br>";
            
               }
                
               ?>
                
            </form>
        </div>
        <form method="post" action="search.php">
            <input type="text" placeholder="Suche nach einem Produkt..." name="search" minlength="3" required><br>
            <button type="submit">Suche</button>
        </form>
         <form method="post" action="searchCategory.php">
            <input type="text" placeholder="Suche nach einer Kategorie..." name="search" minlength="3" required><br>
            <button type="submit">Suche</button>
        </form>
        <form action="index.php">
            <button>Zeige mir alle Produkte</button>
        </form>
           <form action="sort.php">
            <button>Nach Preis sortieren (aufsteigend)</button>
        </form>
         </form>
           <form action="sortAbsteigend.php">
            <button>Nach Preis sortieren (absteigend)</button>
        </form>
                  <button id="modal-btn">Neues Produkt hinzufuegen</button>
          <div class="modal">
                <div class="modal-content">
    <span class="close-btn">&times;</span>
    <form method="post" action="createNewProduct.php" enctype="multipart/form-data">
        <input type="text" minlength="2" placeholder="Titel des Produktes..." name="title" required>
        <br>
        <input type="text" minlength="1" placeholder="Preis in Euro...." name="price" required>
        <br>
        <div>
            <label>Bild hinzufuegen</label><br>
            <input type="file" name="image">
        </div>
        <br>
        <input name="category" type="text" minlength="2" placeholder="Kategorie des Produktes..." required>
        <br>
        <button type="submit">Produkt hinzufuegen</button>
    </form>
  </div>
</div>
  <div id="preisspanne">
            <form method="post" action="preisspanne.php">
        <input id="minprice" name="minprice" type="number" min="0.01" max="10000" step="0.01" placeholder ="Minimaler Preis" required>
        <input id="maxprice" name="maxprice" type="number" min="1" max="10000" step="0.01" placeholder="Maximaler Preis" required>    
        <button type="submit">Filtern</button>
        </form>
        </div>
        <?php
        
        $connection = new mysqli("localhost","timohh97_admin1","449060data","timohh97_phpdata");
        
           if($_SESSION["category"]=="all" || is_null($_SESSION["category"]))
        {
            if(is_null($_SESSION["minprice"]))
            {
                $query = "SELECT * FROM shop ORDER BY price DESC";
            }
            else
            {
                $min = $_SESSION["minprice"];
                $max = $_SESSION["maxprice"];
                
                
                $query = "SELECT * FROM shop WHERE price BETWEEN '$min' AND '$max' ORDER BY price DESC";
            }
            
        }
        else
        {
            
            if(is_null($_SESSION["minprice"]))
            {
                $query = "SELECT * FROM shop WHERE category='".$_SESSION["category"]."' ORDER BY price DESC";
            }
            else
            {
                $min = $_SESSION["minprice"];
                $max = $_SESSION["maxprice"];
                
                   $query = "SELECT * FROM shop WHERE price BETWEEN '$min' AND '$max' AND category='".$_SESSION["category"]."' ORDER BY price DESC"; 
              
            }
           
        
        }
        
        $result = mysqli_query($connection,$query);
        
        
        while($row= mysqli_fetch_row($result))
        {
            
            
            echo "<div id='product'>
                    <div id='title'>".$row[1]."</div>
                    <div id='price'> Preis: ".$row[2]." Euro</div>
                    <img id='picture' src='./images/".$row[3]."'>
                  </div>";
            
        }
        
        
        ?>
        <script src="modal.js"></script>
        
    </body>
</html>