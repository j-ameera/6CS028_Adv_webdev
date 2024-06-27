<?php include APPPATH . 'views/home/header.php'; ?>

<!-- Link to style2.css -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/style2.css'); ?>">

<!-- Search Bar -->
<section id="search-bar">
    <form id="search-form">
        <input type="text" id="search-input" placeholder="Search by hashtag">
        <div id="suggestions"></div> <!-- Container for suggestions -->
    </form>
</section>

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
                <div class="blog-box" data-hashtags="<?php echo $post->hashtags; ?>">
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
                        <a class="post-title"><?php echo $post->title; ?></a>
                        <p><?php echo substr($post->content, 0, 100); ?>...</p>
                        <?php if (!empty($post->hashtags)): ?>
                            <p>Hashtags: <?php echo $post->hashtags; ?></p>
                        <?php endif; ?>
                        <a href="<?php echo base_url('home/view/' . $post->id); ?>">Read More</a>
                        <?php if ($this->session->userdata('role') == 'admin'): ?>
                            <a href="<?php echo base_url('blog/delete/' . $post->id); ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Content for no posts -->
            <p>No posts to display.</p>
        <?php endif; ?>
    </div>
</section>

<!-- JavaScript for filtering posts and showing suggestions -->
<script>
    document.getElementById('search-input').addEventListener('input', function() {
        const query = this.value;
        const blogBoxes = document.querySelectorAll('.blog-box');

        // Filter posts based on the search query
        blogBoxes.forEach(function(box) {
            const hashtags = box.getAttribute('data-hashtags').toLowerCase();
            if (hashtags.includes(query.toLowerCase())) {
                box.style.display = '';
            } else {
                box.style.display = 'none';
            }
        });

        // Fetch and display suggestions for hashtags
        if (query.startsWith('#')) {
            fetch(`<?php echo site_url('home/search_hashtags'); ?>?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    const suggestions = document.getElementById('suggestions');
                    suggestions.innerHTML = '';
                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.textContent = item;
                        div.className = 'suggestion-item';
                        div.addEventListener('click', function() {
                            document.getElementById('search-input').value = item;
                            suggestions.innerHTML = '';
                            // Trigger the input event to filter posts
                            document.getElementById('search-input').dispatchEvent(new Event('input'));
                        });
                        suggestions.appendChild(div);
                    });
                });
        } else {
            document.getElementById('suggestions').innerHTML = '';
        }
    });
</script>

<style>
    /* Styles for suggestions */
    #suggestions {
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
        background: white;
        position: absolute;
        width: calc(100% - 20px);
    }
    .suggestion-item {
        padding: 10px;
        cursor: pointer;
    }
    .suggestion-item:hover {
        background-color: #f0f0f0;
    }
</style>

<?php include APPPATH . 'views/home/footer.php'; ?>
