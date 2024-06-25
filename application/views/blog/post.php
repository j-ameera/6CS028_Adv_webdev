<?php include APPPATH . 'views/home/header.php'; ?>

<!-- Link to post.css -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/post.css'); ?>">

<!-- BLOG DESIGN STARTS HERE -->
<section id="blog">
    <!-- HEADING -->
    <div class="blog-heading">
        <span><?php echo $post->title; ?></span>
    </div>
    <!-- container -->
    <div class="blog-container">
        <!-- Display the individual blog post -->
        <div class="blog-box">
            <!-- img -->
            <div class="blog-img">
                <?php if (!empty($post->image)): ?>
                    <img src="<?php echo base_url('uploads/' . $post->image); ?>" alt="Blog">
                <?php else: ?>
                    <img src="https://via.placeholder.com/1000x600" alt="Blog">
                <?php endif; ?>
            </div>
            <!-- DESCRIPTION -->
            <div class="blog-text">
                <span><?php echo date('d F Y', strtotime($post->created_at)); ?></span>
                <p><?php echo nl2br($post->content); ?></p>
                <?php if (!empty($post->video_url)): ?>
                    <div class="blog-video">
                        <iframe width="560" height="315" src="<?php echo str_replace('watch?v=', 'embed/', $post->video_url); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
                <a href="<?php echo base_url('blog/delete/' . $post->id); ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
            </div>
        </div>
    </div>
</section>

<?php include APPPATH . 'views/home/footer.php'; ?>
