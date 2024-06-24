<?php include APPPATH . 'views/home/header.php'; ?>

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
                <!-- Placeholder image or a default one; adjust according to your needs -->
                <img src="https://via.placeholder.com/1000x600" alt="Blog">
            </div>
            <!-- DESCRIPTION -->
            <div class="blog-text">
                <span><?php echo date('d F Y', strtotime($post->created_at)); ?></span>
                <p><?php echo nl2br($post->content); ?></p>
            </div>
        </div>
    </div>
</section>

<?php include APPPATH . 'views/home/footer.php'; ?>
