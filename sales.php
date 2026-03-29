<?php include("header.php"); ?>
<?php include("database.php"); ?>

<h3>Sell Artwork</h3>

<form method="POST">
    <input type="number" name="artwork_id" placeholder="Artwork ID" required><br><br>
    
    <input type="number" step="0.01" name="sale_price" placeholder="Sale Price" required><br><br>
    
    <input type="date" name="sale_date" required><br><br>
    
    <input type="submit" name="sell_artwork" value="Sell Artwork">
</form>

<br><hr><br>

<?php

if(isset($_POST['sell_artwork'])){
    $artwork_id = $_POST['artwork_id'];
    $sale_price = $_POST['sale_price'];
    $sale_date = $_POST['sale_date'];

    $check_sql = "SELECT * FROM sales WHERE artwork_id = '$artwork_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if(mysqli_num_rows($check_result) > 0){
        echo "<p>This artwork is already sold!</p>";
    } else {

        $insert_sql = "INSERT INTO sales (artwork_id, sale_price, sale_date)
                       VALUES ('$artwork_id', '$sale_price', '$sale_date')";

        if(mysqli_query($conn, $insert_sql)){
            
            $update_sql = "UPDATE artworks SET available = FALSE WHERE id = '$artwork_id'";
            mysqli_query($conn, $update_sql);

            echo "<p>Artwork sold successfully!</p>";
            
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<h2>Sold Artworks</h2>

<?php

$sql = "SELECT artworks.title, artists.name, sales.sale_price, sales.sale_date, artworks.image_url
        FROM sales
        INNER JOIN artworks
        ON sales.artwork_id = artworks.id
        INNER JOIN artists
        ON artworks.artist_id = artists.id";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        
        echo "<div style='border:1px solid black; padding:10px; margin-bottom:15px; border-radius:8px;'>";
        
        echo "<h3>" . $row["title"] . "</h3>";
        echo "<p>Artist: " . $row["name"] . "</p>";
        echo "<p>Sold Price: $" . $row["sale_price"] . "</p>";
        echo "<p>Sold Date: " . $row["sale_date"] . "</p>";
        
        echo "<img src='" . $row['image_url'] . "' width='200'><br><br>";
        
        echo "</div>";
    }
} else {
    echo "No sales found.";
}

?>

<?php include("footer.php"); ?>