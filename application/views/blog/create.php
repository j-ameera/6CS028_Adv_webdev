<!DOCTYPE html>
<html>
<head>
    <title>Create Blog Post</title>
</head>
<body>
    <h2>Create Blog Post</h2>
    <form method="post" action="<?php echo site_url('blog/store'); ?>">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="content">Content</label>
        <textarea name="content" id="content" required></textarea>
        <br>
        <button type="submit">Create Post</button>
    </form>
</body>
</html>
