<?php include("header.php"); ?>
<?php include("database.php"); ?>

<h2>Exhibitions</h2>

<h3>Add Artwork to Exhibition</h3>

<form method="POST">
    <input type="text" name="exhibition_name" placeholder="Exhibition Name" required><br><br>
    
    <input type="number" name="artwork_id" placeholder="Artwork ID" required><br><br>
    
    <input type="submit" name="add_to_exhibition" value="Add">
</form>

<br><hr><br>

<?php

if(isset($_POST["add_to_exhibition"])){
    $exhibition_name = $_POST["exhibition_name"];
    $artwork_id = $_POST["artwork_id"];

    $find_sql = "SELECT id FROM exhibitions WHERE name = '$exhibition_name'";
    $find_result = mysqli_query($conn, $find_sql);

    if(mysqli_num_rows($find_result) > 0){
        $row = mysqli_fetch_assoc($find_result);
        $exhibition_id = $row["id"];

        $insert_sql = "INSERT INTO exhibition_artworks (exhibition_id, artwork_id)
                       VALUES ('$exhibition_id', '$artwork_id')";

        if(mysqli_query($conn, $insert_sql)){
            echo "<p>Artwork added to exhibition!</p>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    } else {
        echo "<p>Exhibition not found.</p>";
    }
}

$sql = "SELECT exhibitions.name AS exhibition_name, exhibitions.date, artworks.title, artworks.image_url
        FROM exhibition_artworks
        INNER JOIN exhibitions
        ON exhibition_artworks.exhibition_id = exhibitions.id
        INNER JOIN artworks
        ON exhibition_artworks.artwork_id = artworks.id";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        
        echo "<div style='border:1px solid black; padding:10px; margin-bottom:15px; border-radius:8px;'>";
        
        echo "<h3>Exhibition: " . $row["exhibition_name"] . "</h3>";
        echo "<p>Date: " . $row["date"] . "</p>";
        echo "<p>Artwork: " . $row["title"] . "</p>";
        
        echo "<img src='" . $row['image_url'] . "' width='200'><br><br>";
        
        echo "</div>";
    }
} else {
    echo "No exhibitions found.";
}

?>

<?php include("footer.php"); ?>