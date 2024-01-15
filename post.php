<link rel="stylesheet" href="style.css">
<?php
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

session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Check if the form for posting a blog is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_title']) && isset($_POST['post_content'])) {
    // Get post details
    $postTitle = $_POST['post_title'];
    $postContent = $_POST['post_content'];

    // For simplicity, let's just append the new post to an array
    $posts = [];

    // Check if posts file exists
    $postsFile = 'posts.json';
    if (file_exists($postsFile)) {
        $posts = json_decode(file_get_contents($postsFile), true);
    }

    $posts[] = [
        'title' => $postTitle,
        'content' => $postContent,
        'author' => $_SESSION['username'],
    ];

    // Save the updated posts array
    file_put_contents($postsFile, json_encode($posts));
}

// Retrieve posts
$posts = [];
$postsFile = 'posts.json';
if (file_exists($postsFile)) {
    $posts = json_decode(file_get_contents($postsFile), true);
}

// Display posts
foreach ($posts as $post) {
    echo '<article>';
    echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
    echo '<p>Author: ' . htmlspecialchars($post['author']) . '</p>';
    echo '<p>' . nl2br(htmlspecialchars($post['content'])) . '</p>';
    echo '</article>';
}

// Display a form for posting a new blog
echo '<section id="post-form">';
echo '<h3>Post a Blog</h3>';
echo '<form method="post" action="">';
echo '<label for="post_title">Title:</label>';
echo '<input type="text" name="post_title" required>';
echo '<label for="post_content">Content:</label>';
echo '<textarea name="post_content" rows="4" required></textarea>';
echo '<button type="submit">Post Blog</button>';
echo '</form>';
echo '</section>';

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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get comment details
    $name = isset($_SESSION['username']) ? $_SESSION['username'] : $_POST['name'];
    $commentText = $_POST['comment'];

    // Validate and process the comment (you can enhance validation as needed)

    // For simplicity, let's just append the comment to an array
    $comments = [];

    // Check if comments file exists
    $commentsFile = 'comments_' . strtolower(str_replace(' ', '_', $post['title'])) . '.json';
    if (file_exists($commentsFile)) {
        $comments = json_decode(file_get_contents($commentsFile), true);
    }

    $comments[] = [
        'name' => $name,
        'comment' => $commentText,
    ];

    // Save the updated comments array
    file_put_contents($commentsFile, json_encode($comments));
}

// Retrieve comments
$comments = [];
$commentsFile = 'comments_' . strtolower(str_replace(' ', '_', $post['title'])) . '.json';
if (file_exists($commentsFile)) {
    $comments = json_decode(file_get_contents($commentsFile), true);
}

// Display comments
echo '<section id="comments">';
echo '<h3>Comments</h3>';
echo '<ul>';
foreach ($comments as $comment) {
    echo '<li><strong>' . htmlspecialchars($comment['name']) . ':</strong> ' . htmlspecialchars($comment['comment']) . '</li>';
}
echo '</ul>';
echo '</section>';
// Display a logout link
echo '<p>Welcome, ' . $_SESSION['username'] . ' | <a href="logout.php">Logout</a></p>';

?>
