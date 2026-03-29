<?php include("header.php"); ?>
<?php include("database.php"); ?>

<h2>Exhibitions</h2>

<?php

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