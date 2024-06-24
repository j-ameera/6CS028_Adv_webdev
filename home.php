<?php include APPPATH . 'views/home/header.php'; ?>

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
                        <?php if (!empty($post->image_url)): ?>
                            <img src="<?php echo $post->image_url; ?>" alt="Blog">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/1000x600" alt="Blog">
                        <?php endif; ?>
                    </div>
                    <!-- DESCRIPTION -->
                    <div class="blog-text">
                        <span><?php echo date('d F Y', strtotime($post->created_at)); ?></span>
                        <a class="post-title"><?php echo $post->title; ?></a>
                        <p><?php echo substr($post->content, 0, 100); ?>...</p>
                        <a href="<?php echo base_url('home/view/' . $post->id); ?>">Read More</a>
                        <a href="<?php echo base_url('blog/delete/' . $post->id); ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Content for no posts -->
            <p>No posts to display.</p>
        <?php endif; ?>
    </div>
</section>

<?php include APPPATH . 'views/home/footer.php'; ?>
