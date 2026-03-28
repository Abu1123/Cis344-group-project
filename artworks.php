<?php include("header.php"); ?>
<?php include("database.php"); ?>

<h2>Artworks</h2>

<form method="GET">
    <input type="text" name="search" placeholder="Search artwork...">
    <input type="submit" value="Search">
</form>

<br>

<h3>Add New Artwork</h3>
<form method="POST">
    <input type="text" name="title" placeholder="Artwork Title" required><br><br>
    <input type="number" name="artist_id" placeholder="Artist ID (1-5)" required><br><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br><br>
    <input type="text" name="image_url" placeholder="Image URL" required><br><br>
    <input type="submit" name="add_artwork" value="Add Artwork">
</form>

<br><hr><br>

<?php

if(isset($_POST["add_artwork"])){
    $title = $_POST["title"];
    $artist_id = $_POST["artist_id"];
    $price = $_POST["price"];
    $image_url = $_POST["image_url"];

    $insert_sql = "INSERT INTO artworks (title, artist_id, price, available, image_url)
                   VALUES ('$title', '$artist_id', '$price', TRUE, '$image_url')";

    if(mysqli_query($conn, $insert_sql)){
        echo "<p>Artwork added successfully!</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if(isset($_POST["delete_artwork"])){
    if(!empty($_POST["delete_ids"])){
        foreach($_POST["delete_ids"] as $id){
            $delete_sql = "DELETE FROM artworks WHERE id = '$id'";
            mysqli_query($conn, $delete_sql);
        }
        echo "<p>Selected artworks deleted!</p>";
    } else {
        echo "<p>No artwork selected.</p>";
    }
}

$search = "";

if(isset($_GET["search"])){
    $search = $_GET['search'];
}

$sql = "SELECT artworks.id, artworks.title, artists.name, artworks.price, artworks.available, artworks.image_url
        FROM artworks
        INNER JOIN artists
        ON artworks.artist_id = artists.id
        WHERE artworks.title LIKE '%$search%'";

$result = mysqli_query($conn, $sql);

if($search != ""){
    echo "<p>Results for: <strong>$search</strong></p>";
}
?>

<form method="POST">

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        
        echo "<div style='border:1px solid black; padding:10px; margin-bottom:15px; border-radius:8px;'>";

        echo "<input type='checkbox' name='delete_ids[]' value='" . $row["id"] . "'> Delete<br><br>";
        
        echo "<h3>" . $row["title"] . "</h3>";
        echo "<p>Artist: " . $row["name"] . "</p>";
        echo "<p>Price: $" . $row["price"] . "</p>";
        echo "<p>Available: " . ($row["available"] ? "Yes" : "No") . "</p>";
        
        echo "<img src='" . $row["image_url"] . "' width='200'><br><br>";
        
        echo "</div>";
    }

    echo "<input type='submit' name='delete_artwork' value='Delete Selected'>";
    
} else {
    echo "No artworks found.";
}
?>

</form>

<?php include("footer.php"); ?>