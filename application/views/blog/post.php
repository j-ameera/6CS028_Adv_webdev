<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- CSS files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/navbar.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/post.css'); ?>" />
    <!-- Custom fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation bar -->
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
                    <?php if (!empty($post->hashtags)): ?>
                        <p>Hashtags: <?php echo $post->hashtags; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($post->video_url)): ?>
                        <div class="blog-video">
                            <iframe width="560" height="315" src="<?php echo str_replace('watch?v=', 'embed/', $post->video_url); ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>

                    <!-- Display the selected GIF -->
                    <?php if (!empty($post->gif_url)): ?>
                        <div class="blog-gif">
                            <img src="<?php echo $post->gif_url; ?>" alt="GIF" onerror="this.style.display='none'">
                        </div>
                    <?php endif; ?>

                    <!-- Only show the delete button if the user is an admin -->
                    <?php if ($this->session->userdata('role') == 'admin'): ?>
                        <form action="<?php echo site_url('blog/delete/' . $post->id); ?>" method="post">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- YouTube Videos Section -->
            <?php if (!empty($videos)): ?>
                <div class="youtube-videos">
                    <h3>Related YouTube Videos</h3>
                    <?php foreach ($videos as $video): ?>
                        <div class="youtube-video">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video['id']['videoId']; ?>" frameborder="0" allowfullscreen></iframe>
                            <p><?php echo $video['snippet']['title']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <h3>Comments</h3>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p><?php echo $comment->content; ?></p>
                        <span>by <?php echo $comment->author; ?> on <?php echo date('d F Y', strtotime($comment->created_at)); ?></span>
                        <a href="#" class="reply" data-comment-id="<?php echo $comment->id; ?>">Reply</a>
                        <!-- Display replies -->
                        <?php if (!empty($comment->replies)): ?>
                            <div class="replies">
                                <?php foreach ($comment->replies as $reply): ?>
                                    <div class="reply-comment">
                                        <p><?php echo $reply->content; ?></p>
                                        <span>by <?php echo $reply->author; ?> on <?php echo date('d F Y', strtotime($reply->created_at)); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>

            <!-- Comment Form -->
            <form action="<?php echo site_url('blog/add_comment/' . $post->id); ?>" method="post">
                <div class="form-group">
                    <label for="comment_content">Add a comment</label>
                    <textarea name="content" id="comment_content" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>
    </section>

    <?php include APPPATH . 'views/home/footer.php'; ?>
</body>
</html>
