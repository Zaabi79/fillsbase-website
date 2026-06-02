<?php
require_once(__DIR__ . "/configuration.php");

$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$article = null;

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($article_id > 0) {
        // Fetch specific article
        $stmt = $pdo->prepare("SELECT title, article, views FROM tblknowledgebase WHERE id = ?");
        $stmt->execute([$article_id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        // Increment views
        $pdo->prepare("UPDATE tblknowledgebase SET views = views + 1 WHERE id = ?")->execute([$article_id]);
    } else {
        // Fallback: Fetch latest article from "Press" category
        $stmt = $pdo->prepare("
            SELECT kb.id, kb.title, kb.article, kb.views
            FROM tblknowledgebase kb
            JOIN tblknowledgebaselinks kbl ON kb.id = kbl.articleid
            WHERE kbl.categoryid = 7 AND kb.language = ''
            ORDER BY kb.id DESC LIMIT 1
        ");
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    $article = null;
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
    <title>Fillsbase - <?php echo $article ? htmlspecialchars($article['title']) : 'Blog Details'; ?></title>
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
            <h1 class="heading"><?php echo $article ? htmlspecialchars($article['title']) : 'Article Not Found'; ?></h1>
            <div class="subheading">Latest news and announcements from Fillsbase.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** BLOG DETAILS ***** -->
  <section class="shopping blog sec-normal pt-80 pb-80 sec-bg2 motpath bg-seccolorstyle">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="wrap-blog">
            <?php if ($article): ?>
                <div class="row mb-5">
                  <div class="col-md-12 col-lg-12">
                    <div class="sec-normal pt-0 bottomhalfpadding">
                      <div class="sec-main sec-bg1 bg-colorstyle noshadow">
                        <div class="row text-blog">
                          <div class="col-sm-12 col-md-12 col-lg-6 p-0">
                            <div class="timer d-flex align-items-center seccolor">
                              <i class="icon-calendar"></i>
                              <span class="ps-2 pe-4"> News Feed</span>
                              <i class="fas fa-eye"></i>
                              <span class="ps-2"> <?php echo htmlspecialchars($article['views']); ?> Views</span>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="heading blog"><a class="mergecolor" href="#"><?php echo htmlspecialchars($article['title']); ?></a></div>
                        <div class="blog-info seccolor mt-3">
                          <?php echo $article['article']; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php else: ?>
                <div class="row">
                  <div class="col-md-12 text-center py-5">
                    <h3 class="mergecolor">Article Not Found</h3>
                    <p class="seccolor">The requested news item could not be retrieved.</p>
                    <a href="press" class="btn btn-default-yellow-fill">Back to Blog</a>
                  </div>
                </div>
            <?php endif; ?>
          </div>
        </div>
        <!-- sidebar -->
        <div class="col-md-4">
          <aside class="sidebar bg-colorstyle noshadow">
            <div class="cd-filter-block checkbox-group">
              <label><a href="#" title="Searching"><i class="fas fa-search"></i></a></label>
              <input type="text" class="input" placeholder="Search..."/>
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