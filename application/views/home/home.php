<?php include 'header.php'; ?>

<!-- BLOG DESIGN STARTS HERE -->
<section id="blog">
    <!-- HEADING -->
    <div class="blog-heading">
        <span>My Recent Posts</span>
    </div>
    <!-- container -->
    <div class="blog-container">
        <!-- Display blog posts -->
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="blog-box">
                    <!-- img -->
                    <div class="blog-img">
                        <!-- Placeholder image or a default one; adjust according to your needs -->
                        <img src="https://via.placeholder.com/1000x600" alt="Blog">
                    </div>
                    <!-- DESCRIPTION -->
                    <div class="blog-text">
                        <span><?php echo date('d F Y', strtotime($post->created_at)); ?></span>
                        <a class="post-title"><?php echo $post->title; ?></a>
                        <p><?php echo substr($post->content, 0, 100); ?>...</p>
                        <a href="<?php echo base_url('home/view/' . $post->id); ?>">Read More</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Content for no posts -->
            <p>No posts to display.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
