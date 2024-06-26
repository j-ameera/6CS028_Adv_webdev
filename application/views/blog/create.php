<?php include APPPATH . 'views/home/header.php'; ?>

<!-- Link to style_create.css -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/create.css'); ?>">

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
        <div class="form-group" style="position: relative;">
            <label for="youtube_keywords">YouTube Keywords</label>
            <input type="text" name="youtube_keywords" id="youtube_keywords" class="form-control" oninput="fetchYouTubeSuggestions()">
            <div id="youtubeSuggestions" class="suggestions" style="display: none;"></div>
        </div>
        <div class="form-group" style="position: relative;">
            <label for="giphy_keywords">GIF Keywords</label>
            <input type="text" name="giphy_keywords" id="giphy_keywords" class="form-control" oninput="fetchGiphySuggestions()">
            <div id="giphySuggestions" class="suggestions" style="display: none;"></div>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    
    <h2>Capture Image</h2>
    <video id="video" width="320" height="240" autoplay></video>
    <button id="snap">Capture</button>
    <canvas id="canvas" width="320" height="240" style="display: none;"></canvas>

    <script src="<?php echo base_url('assets/js/camera.js'); ?>"></script>
    <style>
        .suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            background-color: white;
            position: absolute;
            z-index: 1000;
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
<script>
function fetchYouTubeSuggestions() {
    const keywords = document.getElementById('youtube_keywords').value;
    if (keywords.length < 3) {
        document.getElementById('youtubeSuggestions').style.display = 'none';
        return;
    }
    
    fetch(`<?php echo site_url('api?type=youtube&keyword='); ?>${keywords}`)
        .then(response => response.json())
        .then(data => {
            const suggestionsBox = document.getElementById('youtubeSuggestions');
            suggestionsBox.innerHTML = '';
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'suggestion-item';
                div.textContent = item.title;
                div.onclick = () => {
                    document.getElementById('video_url').value = `https://www.youtube.com/watch?v=${item.videoId}`;
                    suggestionsBox.style.display = 'none';
                };
                suggestionsBox.appendChild(div);
            });
            suggestionsBox.style.display = 'block';
        })
        .catch(error => console.error('Error fetching YouTube suggestions:', error));
}

function fetchGiphySuggestions() {
    const keywords = document.getElementById('giphy_keywords').value;
    if (keywords.length < 3) {
        document.getElementById('giphySuggestions').style.display = 'none';
        return;
    }

    fetch(`<?php echo site_url('api?type=giphy&keyword='); ?>${keywords}`)
        .then(response => response.json())
        .then(data => {
            const suggestionsBox = document.getElementById('giphySuggestions');
            suggestionsBox.innerHTML = '';
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'suggestion-item';
                div.textContent = item.title;
                div.onclick = () => {
                    // Do something with the GIF URL, e.g., display it
                    suggestionsBox.style.display = 'none';
                };
                suggestionsBox.appendChild(div);
            });
            suggestionsBox.style.display = 'block';
        })
        .catch(error => console.error('Error fetching Giphy suggestions:', error));
}
</script>

</div>

<?php include APPPATH . 'views/home/footer.php'; ?>
