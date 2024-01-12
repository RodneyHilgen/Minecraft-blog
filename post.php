<link rel="stylesheet" href="style.css">
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}


// voorbeelden van de blogs
$posts = [
    [
        'title' => 'Exploring Minecraft Biomes',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
        'image' => 'images/biomes.jpg',
    ],
    [
        'title' => 'Building Epic Castles in Minecraft',
        'content' => 'Nullam quis risus eget urna mollis ornare vel eu leo...',
        'image' => 'images/castle.jpg',
    ],
];


// Display comment form
echo '<section id="comment-form">';
echo '<h3>Add a Comment</h3>';
echo '<form method="post" action="">';
echo '<label for="name">Your Name:</label>';
echo '<input type="text" name="name" required>';
echo '<label for="comment">Your Comment:</label>';
echo '<textarea name="comment" rows="4" required></textarea>';
echo '<button type="submit">Submit Comment</button>';
echo '</form>';
echo '</section>';



// Display blog posts
foreach ($posts as $post) {
    echo '<article>';
    echo '<h2>' . $post['title'] . '</h2>';
    echo '<img src="' . $post['image'] . '" alt="' . $post['title'] . '">';
    echo '<p>' . $post['content'] . '</p>';
    echo '<a href="post.php">Read more</a>';
    echo '</article>';
} 


// Display comment form
echo '<section id="comment-form">';
echo '<h3>Add a Comment</h3>';
echo '<form method="post" action="">';
if (isset($_SESSION['username'])) {
    // If logged in, use the username as the default name
    echo '<input type="hidden" name="name" value="' . htmlspecialchars($_SESSION['username']) . '">';
} else {
    // If not logged in, allow user to enter a name
    echo '<label for="name">Your Name:</label>';
    echo '<input type="text" name="name" required>';
}
echo '<label for="comment">Your Comment:</label>';
echo '<textarea name="comment" rows="4" required></textarea>';
echo '<button type="submit">Submit Comment</button>';
echo '</form>';
echo '</section>';





// Rest of your code...

// Display a logout link
echo '<p>Welcome, ' . $_SESSION['username'] . ' | <a href="logout.php">Logout</a></p>';

?>
