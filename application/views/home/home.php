  <?php include 'header.php'; ?>
    <!-- BLOG DESIGN STARTS HERE -->
    <section id="blog">
      <!-- HEADING -->
      <div class="blog-heading">
        <span>My Recent Posts</span>
      </div>
      <!-- container -->
      <div class="blog-container">
        <!-- latest post(1) -->
        <div class="blog-box">
          <!-- img -->
          <div class="blog-img">
            <img src="https://as1.ftcdn.net/v2/jpg/02/00/07/14/1000_F_200071450_ONuxtbxORzD289pYFPOIbc3GupmMsa67.jpg" alt="Blog">
          </div>
          <!-- DESCRIPTION -->
          <div class="blog-text">
            <span>11 January 2022</span>
            <a class="post-title">A trip to Italy</a>
            <p>I don't know much about Italy, not even much about the landmarks. Only that it has a city called Venice...</p>
            <a href="<?php echo base_url('Home/article_read_more') . '?article=1' ?>">Read More</a>
          </div>
        </div>
        <!-- second post(2) -->
        <div class="blog-box">
          <!-- img -->
          <div class="blog-img">
            <img src="https://as1.ftcdn.net/v2/jpg/02/05/57/92/1000_F_205579298_ZjRE5sn1k0Zkzm6VNCNtk6FUfRxbY1ex.jpg" alt="blog">
          </div>
          <!-- DESCRIPTION -->
          <div class="blog-text">
            <span>5 January 2022</span>
            <a class="post-title">Throwback to December</a>
            <p>It didn't snow much in my area, but I was lucky enough to visit my family's house up in the mountains...</p>
          <a href="<?php echo base_url('Home/article_read_more') . '?article=2' ?>">Read More</a>
          </div>
        </div>
        <!-- third post(3) -->
        <div class="blog-box">
          <!--img---->
          <div class="blog-img">
            <img src="https://as1.ftcdn.net/v2/jpg/05/05/94/46/1000_F_505944656_bDxox5xmlMWq2S5x8Q9lutGw7BBKmzKK.jpg" alt="blog">
          </div>
          <!-- DESCRIPTION -->
          <div class="blog-text">
            <span>17 August 2021</span>
            <a class="post-title">Purple isn't my favourite colour!</a>
            <p>It's really not. But it's definitely one of the ones I like the most. I bought this after an outing...</p>
           <a href="<?php echo base_url('Home/article_read_more') . '?article=3' ?>">Read More</a>
          </div>
        </div>
        <!-- oldest post(4) -->
        <div class="blog-box">
          <!-- img -->
          <div class="blog-img">
            <img src="https://as2.ftcdn.net/v2/jpg/02/11/64/83/1000_F_211648365_3HfacqvMClKTSYyItzgUHsVy2oO4kNye.jpg" alt="blog">
          </div>
          <!-- DESCRIPTION -->
          <div class="blog-text">
            <span>20 April 2021</span>
            <a class="post-title">My Birthday!</a>
            <p>Nothing too exciting, just went out to a restaurant later in the evening. I got a couple of gifts, it was nice...</p>
          <a href="<?php echo base_url('Home/article_read_more') . '?article=4' ?>">Read More</a>
          </div>
        </div>
      </div>
    </section>
  <?php include 'footer.php'; ?>