<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Minecraft Blog</title>
</head>
<body>
    <header>
        <h1>Minecraft Blog</h1>
    </header>

    <main>
    <?php

    include 'post.php'; 
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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get comment details
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    // Validate and process the comment (you can enhance validation as needed)

    // For simplicity, let's just append the comment to an array
    $comments[] = [
        'name' => $name,
        'comment' => $comment,
    ];

    // Save the updated comments array (you can use a database in a real-world scenario)
    // In this example, we'll save it in a file
    file_put_contents('comments.json', json_encode($comments));
}

// Retrieve comments (you can use a database for this in a real-world scenario)
$comments = [];
if (file_exists('comments.json')) {
    $comments = json_decode(file_get_contents('comments.json'), true);
}

// Display post content
echo '<article>';
echo '<h2>' . $post['title'] . '</h2>';
echo '<img src="' . $post['image'] . '" alt="' . $post['title'] . '">';
echo '<p>' . $post['content'] . '</p>';
echo '</article>';

// Display comments
echo '<section id="comments">';
echo '<h3>Comments</h3>';
echo '<ul>';
foreach ($comments as $comment) {
    echo '<li><strong>' . htmlspecialchars($comment['name']) . ':</strong> ' . htmlspecialchars($comment['comment']) . '</li>';
}
echo '</ul>';
echo '</section>';

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
?>

    </main>


</body>
</html>
