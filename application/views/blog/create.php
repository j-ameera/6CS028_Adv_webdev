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
            const keyword = document.getElementById('youtube_keywords').value;
            if (keyword.length > 2) {
                fetch(`/index.php/api/get_youtube_suggestions?keyword=${keyword}`)
                    .then(response => response.json())
                    .then(data => {
                        let suggestionsHTML = '';
                        data.forEach(item => {
                            suggestionsHTML += `<div class="suggestion-item" onclick="selectYouTubeSuggestion('${item.title}')">${item.title}</div>`;
                        });
                        document.getElementById('youtubeSuggestions').innerHTML = suggestionsHTML;
                        document.getElementById('youtubeSuggestions').style.display = 'block';
                    })
                    .catch(error => console.error('Error fetching YouTube suggestions:', error));
            } else {
                document.getElementById('youtubeSuggestions').style.display = 'none';
            }
        }

        function fetchGiphySuggestions() {
            const keyword = document.getElementById('giphy_keywords').value;
            if (keyword.length > 2) {
                fetch(`/index.php/api/get_giphy_suggestions?keyword=${keyword}`)
                    .then(response => response.json())
                    .then(data => {
                        let suggestionsHTML = '';
                        data.forEach(item => {
                            suggestionsHTML += `<div class="suggestion-item" onclick="selectGiphySuggestion('${item.title}')">${item.title}</div>`;
                        });
                        document.getElementById('giphySuggestions').innerHTML = suggestionsHTML;
                        document.getElementById('giphySuggestions').style.display = 'block';
                    })
                    .catch(error => console.error('Error fetching Giphy suggestions:', error));
            } else {
                document.getElementById('giphySuggestions').style.display = 'none';
            }
        }

        function selectYouTubeSuggestion(title) {
            document.getElementById('youtube_keywords').value = title;
            document.getElementById('youtubeSuggestions').style.display = 'none';
        }

        function selectGiphySuggestion(title) {
            document.getElementById('giphy_keywords').value = title;
            document.getElementById('giphySuggestions').style.display = 'none';
        }
    </script>
</div>

<?php include APPPATH . 'views/home/footer.php'; ?>
