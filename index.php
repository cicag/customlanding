<?php
$data = json_decode(file_get_contents(__DIR__ . '/src/data/data.json'), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon" />
  <link rel="apple-touch-icon" href="public/img/apple-touch-icon.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="public/img/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="public/img/apple-touch-icon-114x114.png" />
  <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="public/fonts/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="public/css/style.css" />
  <link rel="stylesheet" type="text/css" href="public/css/nivo-lightbox/nivo-lightbox.css" />
  <link rel="stylesheet" type="text/css" href="public/css/nivo-lightbox/default.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet" />
  <title>A Landing Page Template</title>
  <meta name="description" content="" />
  <meta name="author" content="" />
  <style>
    #particles-js { position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 0; }
    .intro .overlay { position: relative; z-index: 1; }
  </style>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
  <nav id="menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </button>
        <a class="navbar-brand page-scroll" href="#page-top">My Landing Page</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#features" class="page-scroll">Features</a></li>
          <li><a href="#about" class="page-scroll">About</a></li>
          <li><a href="#services" class="page-scroll">Services</a></li>
          <li><a href="#portfolio" class="page-scroll">Gallery</a></li>
          <li><a href="#testimonials" class="page-scroll">Testimonials</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <header id="header">
    <div class="intro">
      <div id="particles-js"></div>
      <div class="overlay">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-offset-2 intro-text">
              <h1><?= htmlspecialchars($data['Header']['title'] ?? 'Loading') ?><span></span></h1>
              <p><?= htmlspecialchars($data['Header']['paragraph'] ?? 'Loading') ?></p>
              <a href="#features" class="btn btn-custom btn-lg page-scroll">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div id="features" class="text-center">
    <div class="container">
      <div class="col-md-10 col-md-offset-1 section-title"><h2>Features</h2></div>
      <div class="row">
        <?php if (!empty($data['Features'])): foreach ($data['Features'] as $f): ?>
          <div class="col-xs-6 col-md-3">
            <i class="fa <?= htmlspecialchars($f['icon']) ?>"></i>
            <h3><?= htmlspecialchars($f['title']) ?></h3>
            <p><?= htmlspecialchars($f['text']) ?></p>
          </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>
  <div id="about">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-6"><img src="public/img/about.jpg" class="img-responsive" alt="" /></div>
        <div class="col-xs-12 col-md-6">
          <div class="about-text">
            <h2>About Us</h2>
            <p><?= htmlspecialchars($data['About']['paragraph'] ?? '') ?></p>
            <h3>Why Choose Us?</h3>
            <div class="list-style">
              <div class="col-lg-6 col-sm-6 col-xs-12">
                <ul><?php if (!empty($data['About']['Why'])): foreach ($data['About']['Why'] as $d): ?><li><?= htmlspecialchars($d) ?></li><?php endforeach; endif; ?></ul>
              </div>
              <div class="col-lg-6 col-sm-6 col-xs-12">
                <ul><?php if (!empty($data['About']['Why2'])): foreach ($data['About']['Why2'] as $d): ?><li><?= htmlspecialchars($d) ?></li><?php endforeach; endif; ?></ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="services" class="text-center">
    <div class="container">
      <div class="section-title"><h2>Our Services</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed dapibus leonec.</p></div>
      <div class="row">
        <?php if (!empty($data['Services'])): foreach ($data['Services'] as $s): ?>
          <div class="col-md-4">
            <i class="fa <?= htmlspecialchars($s['icon']) ?>"></i>
            <div class="service-desc"><h3><?= htmlspecialchars($s['name']) ?></h3><p><?= htmlspecialchars($s['text']) ?></p></div>
          </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>
  <div id="portfolio" class="text-center">
    <div class="container">
      <div class="section-title"><h2>Gallery</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed dapibus leonec.</p></div>
      <div class="row">
        <div class="portfolio-items">
          <?php $gallery = [
            ['thumb' => 'public/img/portfolio/01-small.jpg', 'title' => 'Lorem Ipsum1'],
            ['thumb' => 'public/img/portfolio/02-small.jpg', 'title' => 'Lorem Ipsum2'],
            ['thumb' => 'public/img/portfolio/03-small.jpg', 'title' => 'Lorem Ipsum3'],
            ['thumb' => 'public/img/portfolio/04-small.jpg', 'title' => 'Lorem Ipsum4'],
            ['thumb' => 'public/img/portfolio/05-small.jpg', 'title' => 'Lorem Ipsum5'],
            ['thumb' => 'public/img/portfolio/06-small.jpg', 'title' => 'Lorem Ipsum6'],
            ['thumb' => 'public/img/portfolio/07-small.jpg', 'title' => 'Lorem Ipsum7'],
            ['thumb' => 'public/img/portfolio/08-small.jpg', 'title' => 'Lorem Ipsum8'],
            ['thumb' => 'public/img/portfolio/09-small.jpg', 'title' => 'Lorem Ipsum9'],
          ]; foreach ($gallery as $g): ?>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class="portfolio-item">
                <div class="hover-bg">
                  <a href="<?= str_replace('-small', '-large', $g['thumb']) ?>" title="<?= htmlspecialchars($g['title']) ?>" data-lightbox-gallery="gallery1">
                    <div class="hover-text"><h4><?= htmlspecialchars($g['title']) ?></h4></div>
                    <img src="<?= $g['thumb'] ?>" class="img-responsive" alt="Project Title" />
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <div id="testimonials">
    <div class="container">
      <div class="section-title text-center"><h2>What our clients say</h2></div>
      <div class="row">
        <?php if (!empty($data['Testimonials'])): foreach ($data['Testimonials'] as $t): 
          $img = $t['img'];
          if (strpos($img, 'img/testimonials/') === 0) {
            $img = 'public/' . $img;
          } elseif (strpos($img, 'public/') !== 0 && strpos($img, 'http') !== 0) {
            $img = 'public/' . ltrim($img, '/');
          }
        ?>
          <div class="col-md-4">
            <div class="testimonial">
              <div class="testimonial-image"><img src="<?= htmlspecialchars($img) ?>" alt="" /></div>
              <div class="testimonial-content">
                <p>"<?= htmlspecialchars($t['text']) ?>"</p>
                <div class="testimonial-meta"> - <?= htmlspecialchars($t['name']) ?></div>
              </div>
            </div>
          </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>
  <div id="footer">
    <div class="container text-center"><p>&copy; <?= date('Y') ?> My Landing Page. Design by <a href="http://www.templatewire.com" rel="nofollow">TemplateWire</a></p></div>
  </div>
  <script type="text/javascript" src="public/js/jquery.1.11.1.js"></script>
  <script type="text/javascript" src="public/js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script type="text/javascript" src="public/js/nivo-lightbox.js"></script>
  <script type="text/javascript" src="public/js/main.js"></script>
</body>
</html>
