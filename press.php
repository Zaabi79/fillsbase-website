<?php
require_once(__DIR__ . "/configuration.php");

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch articles from "Press" category (ID 7)
    $stmt = $pdo->prepare("
        SELECT kb.id, kb.title, kb.article, kb.views
        FROM tblknowledgebase kb
        JOIN tblknowledgebaselinks kbl ON kb.id = kbl.articleid
        WHERE kbl.categoryid = 7 AND kb.language = ''
        ORDER BY kb.id DESC
    ");
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $articles = [];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillsbase.com provides premium web hosting, VPS, dedicated servers, and domain registration services.">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <title>Fillsbase - Press</title>
    <!-- Font Style -->
    <link href="assets/fonts/fontawesome/css/all.min.css" rel='stylesheet'>
    <link href="assets/fonts/fonts.min.css" rel='stylesheet'>
    <!-- CSS Style -->
    <link type="text/css" href="assets/css/bootstrap.min.css" rel='stylesheet' class="ltr">
    <link type="text/css" href="assets/css/vendors.min.css" rel='stylesheet'>
    <link type="text/css" href="assets/css/theme.min.css" rel='stylesheet'>
    <link href="assets/css/fillsbase_custom.css?v=4.0" rel="stylesheet">
    <!-- Javascript -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/gdpr-cookie.min.js"></script>
    <script defer type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script defer type="text/javascript" src="assets/js/slick.min.js"></script>
    <script defer type="text/javascript" src="assets/js/aos.min.js"></script>
    <script defer type="text/javascript" src="assets/js/swiper.min.js"></script>
    <script defer type="text/javascript" src="assets/js/jquery.lazyload-any.min.js"></script>
    <script defer type="text/javascript" src="assets/js/scripts.min.js"></script>
    <script defer type="text/javascript" src="assets/js/settings-init.js"></script>
  </head>
  <body >
    <div class="box-container limit-width">
      <!-- ***** SETTINGS ****** -->
    <section id="settings"> </section>
    <!-- ***** LOADING PAGE ****** -->
    <div id="spinner-area">
      <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
        <div class="spinner-txt">Fillsbase...</div>
      </div>
    </div>
    <!-- ***** FRAME MODE ****** -->
    <div class="body-borders" data-border="20">
      <div class="top-border bg-white"></div>
      <div class="right-border bg-white"></div>
      <div class="bottom-border bg-white"></div>
      <div class="left-border bg-white"></div>
    </div>
    <!-- ***** UPLOADED MENU FROM HEADER.HTML ***** -->
  <header id="header"> </header>
  <!-- ***** BANNER ***** -->
  <div class="top-header overlay" style="background: #111 url('assets/img/about-bg.png?v=1.1') no-repeat center center / cover !important; min-height: 400px; position: relative;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper">
            <h1 class="heading">Press</h1>
            <div class="subheading">The latest news and announcements about all our servers and services.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Blog Grid ***** -->
  <section class="services blog sec-normal pt-80 pb-5 bg-colorstyle">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="service-wrap">
            <div class="row">
              <?php if (empty($articles)): ?>
                <div class="col-md-12 text-center py-5">
                  <h3 class="mergecolor">No news articles found in the Press category.</h3>
                  <p class="seccolor">Check back later for more updates!</p>
                </div>
              <?php else: ?>
                <?php foreach ($articles as $article): ?>
                  <div class="col-md-12 col-lg-12 col-xl-6 mb-5">
                    <div class="action-content">
                      <div class="action rounded-bottom">
                        <div class="metatag">
                          <div class="kudos">
                            <a href="#" title="Views"><i class="fas fa-eye ps-0"></i> <?php echo htmlspecialchars($article['views']); ?></a>
                          </div>
                        </div>
                      </div>
                      <div class="lazyload" style="background: #222; min-height: 200px; display: flex; align-items: center; justify-content: center; border-radius: 12px 12px 0 0;">
                        <i class="fas fa-newspaper fa-4x text-muted"></i>
                      </div>
                    </div>
                    <div class="service-section m-0 bg-seccolorstyle noshadow">
                      <div class="plans badge feat bg-dark">press</div>
                      <div class="title mt-0 mergecolor"><?php echo htmlspecialchars($article['title']); ?></div>
                      <p class="subtitle seccolor">
                        <?php 
                          $excerpt = strip_tags($article['article']);
                          if (strlen($excerpt) > 150) {
                              $excerpt = substr($excerpt, 0, 150) . "...";
                          }
                          echo htmlspecialchars($excerpt);
                        ?>
                      </p>
                      <hr>
                      <div class="small d-flex align-items-center seccolor">
                        <b class="icon-calendar text-dark seccolor"></b>
                        <span class="ps-2 pe-4"> Latest Post</span>
                        <b class="icon-man text-dark seccolor"></b>
                        <span class="ps-2"> by Admin</span>
                      </div>
                      <a href="blog-details?id=<?php echo $article['id']; ?>" class="btn btn-default-yellow-fill">Continue Reading</a>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <!-- sidebar -->
        <div class="col-md-4">
          <aside class="sidebar bg-seccolorstyle noshadow ">
            <div class="cd-filter-block checkbox-group">
              <label><a href="#" title="Searching"><i class="fas fa-search"></i></a></label>
              <input type="text" class="input" placeholder="Search..."/>
            </div>
            <div class="posts">
              <div class="tabs">
                <div class="tabs-header">
                  <ul class="list">
                    <li class="seccolor active">Recent Posts</li>
                  </ul>
                </div>
                <div class="tabs-content">
                  <div class="tabs-item active">
                    <?php 
                    $recent = array_slice($articles, 0, 3);
                    foreach ($recent as $post): ?>
                    <div class="item-wrap">
                      <div class="heading-article"><a href="blog-details?id=<?php echo $post['id']; ?>" class="seccolor"><?php echo htmlspecialchars($post['title']); ?></a></div>
                      <a href="blog-details?id=<?php echo $post['id']; ?>" title="Read More" class="c-grey seccolor"><small><i class="far fa-file-alt"></i> View Article</small></a>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="newsletter">
              <div class="heading active">Newsletter</div>
              <div class="line active"></div>
              <p><small class="text-muted seccolor">Subscribe to our newsletter to receive news and updates. Enter your Email!</small></p>
              <div class="row">
                <div class="col-md-12 col-lg-12 cd-filter-block mb-0">
                  <input type="email" name="email" placeholder="news@youremail.com" required="">
                  <a href="#" title="Subscribe" class="btn btn-default-grad-purple-fill w-100 mt-3">Subscribe</a>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** UPLOADED FOOTER FROM FOOTER.HTML ***** -->
<footer id="footer"> </footer>
</div>
<!-- ***** BUTTON GO TOP ***** -->
<a href="#" class="cd-top" title="Go Top"> <i class="fas fa-angle-up"></i> </a>
</body>
</html>