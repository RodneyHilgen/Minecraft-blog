<?php
// Retrieve post details (you can use a database for this in a real-world scenario)
$post = [
    'title' => 'Exploring Minecraft Biomes',
    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
    'image' => 'images/biomes.jpg',
];

// Display individual post
echo '<article>';
echo '<h2>' . $post['title'] . '</h2>';
echo '<img src="' . $post['image'] . '" alt="' . $post['title'] . '">';
echo '<p>' . $post['content'] . '</p>';
echo '<a href="index.php">Back to Blog</a>';
echo '</article>';
?>
