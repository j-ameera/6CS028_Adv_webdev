<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
    <div class="container">
        <h2>Create Post</h2>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <form id="postForm" action="<?php echo site_url('blog/store'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="video_url">YouTube Video URL</label>
                <input type="text" name="video_url" id="video_url" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        
        <h2>Capture Image</h2>
        <video id="video" width="320" height="240" autoplay></video>
        <button id="snap">Capture</button>
        <canvas id="canvas" width="320" height="240" style="display: none;"></canvas>

        <script src="<?php echo base_url('assets/js/camera.js'); ?>"></script>
    </div>
</body>
</html>
