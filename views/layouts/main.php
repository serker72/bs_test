<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\BsTestAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
BsTestAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!---------------------------------------------------------------------------------------------------------------->
<!-- header -->
<header id="image-slider-header" data-section="home">
    <div class="container">
        <div id="home">
<!-- top menu -->
<div class="top-menu">
    <p>
        <span class="left">
            <a href="tel:+0123456789"><i class="lnr lnr-phone-handset"></i>+0123 456 789</a>
            <a href="mailto:hello@simplycity.com"><i class="lnr lnr-envelope"></i>hello@simplycity.com</a>
        </span>
        <span class="right">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
            <a href="#"><i class="fa fa-dribbble"></i></a>
        </span>
    </p>
</div><!-- / top menu -->
<!-- navbar -->
<nav id="sticky-nav" class="navbar navbar-1">
    <div class="container-fluid navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="SimplyCity"/>
        </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse text-center">
        <ul class="nav navbar-nav">
            <li ><a class="page-scroll" href="#home" data-nav-section="home"><span>HOME</span></a></li>
            <li><a class="page-scroll" href="#about" data-nav-section="about"><span>ABOUT</span></a></li>
            <li><a class="page-scroll" href="#services" data-nav-section="services"><span>FEATURES</span></a></li>
            <label class="btn btn-success"><a class="page-scroll" href="#" data-nav-section="#"><span>LOGIN</span></a></label>
            <label class="btn btn-info"><a class="page-scroll" href="#" data-nav-section="#"><span>REGISTER</span></a></label>
        </ul>
    </div><!--/.nav-collapse -->
</nav><!-- / navbar -->
</div>
</div><!-- / container -->
<!-- image slider -->
    <div id="image-slider" class="carousel slide">  
      <div class="carousel-inner">
        <div class="item active slide1">
          <div class="container">
            <div class="carousel-caption">
              <h2 class="animated fadeInDown">SIMPLYCITY - LANDING PAGE 3</h2>
              <p class="animated fadeInDown">Aenean vel egestas augue, faucibu</p>
              <div class="fifth animated fadeIn">
                  <img src="images/desktop-image.png" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="item slide2">
          <div class="container">
            <div class="carousel-caption">
              <h2 class="animated fadeInDown">BUILD YOUR OWN LAYOUT EASILY</h2>
              <p class="animated fadeInDown">Aenean vel egestas augue</p>
              <div class="fifth animated fadeIn">
                  <img src="images/layout-image.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div><!-- / image slider -->
      <!-- Controls -->
      <a class="left carousel-control" href="#image-slider" data-slide="prev"><span class="lnr lnr-chevron-left"></span></a>
      <a class="right carousel-control" href="#image-slider" data-slide="next"><span class="lnr lnr-chevron-right"></span></a>  
    </div><!-- / home -->
</header><!-- / header -->


<!-- about section 4col -->
<div id="about" data-section="about">
    <div class="container">
        <div class="page-header wsub first">
            <h2>ABOUT</h2>
        </div>
        <div class="sub-header">
            <h4>SimpliCity is a beautiful fully responsive Bootstrap Theme.</h4>
        </div>
        <div class="row">
            <div class="about col-sm-3">
                <div class="feature-icon">
                    <i class="lnr lnr-laptop-phone"></i>
                </div>
                <h5 class="about-title">RESPONSIVE</h5>
                <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet</p>
            </div>
            <div class="about col-sm-3">
                <div class="feature-icon">
                    <i class="lnr lnr-eye"></i>
                </div>
                <h5 class="about-title">RETINA READY</h5>
                <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet</p>
            </div>
            <div class="about col-sm-3">
                <div class="feature-icon">
                    <i class="lnr lnr-code"></i>
                </div>
                <h5 class="about-title">CLEAN CODE</h5>
                <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet</p>
            </div>
            <div class="about col-sm-3">
                <div class="feature-icon">
                    <i class="lnr lnr-pencil"></i>
                </div>
                <h5 class="about-title">EASY TO EDIT</h5>
                <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet</p>
            </div>
        </div>
    </div><!-- / container -->
</div><!-- / about section -->


<!-- features section 4col image-left -->
<!-- services section 4col -->
<div id="services" data-section="services">
    <div class="container">
        <div class="page-header wsub first">
            <h2>FEATURES</h2>
        </div>
        <div class="sub-header">
            <h4>Explore the features</h4>
        </div>
        <div class="row">
            <div class="service col-sm-6 col-md-3">
                <div class="service-icon">
                    <i class="lnr lnr-laptop-phone"></i>
                </div>
                <h5 class="service-title">RESPONSIVE DESIGN</h5>
                <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet.</p>
            </div>
            <div class="service col-sm-6 col-md-3">
                <div class="service-icon">
                    <i class="lnr lnr-book"></i>
                </div>
                <h5 class="service-title">WELL DOCUMENTED</h5>
                <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet.</p>
            </div>
            <div class="service col-sm-6 col-md-3">
                <div class="service-icon">
                    <i class="lnr lnr-eye"></i>
                </div>
                <h5 class="service-title">RETINA READY</h5>
                <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet.</p>
            </div>
            <div class="service col-sm-6 col-md-3">
                <div class="service-icon">
                    <i class="lnr lnr-envelope"></i>
                </div>
                <h5 class="service-title">27/7 SUPPORT</h5>
                <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet.</p>
            </div>
        </div>
    </div><!-- / container -->
</div><!-- / services section 4col -->


<!-- features section image-left -->
<div id="features" data-section="features">
    <div class="container">
        <div class="row">
            <div class="feature-image-left col-sm-12 col-md-7">
                <img src="images/feature-image-left.png" alt="">
            </div>
            <div class="features-left image-left col-xs-12 col-md-5">
                <div class="feature">
                    <div class="feature-icon">
                        <i class="lnr lnr-pencil"></i>
                    </div>
                    <h5>RESPONSIVE DESIGN</h5>
                    <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">
                        <i class="lnr lnr-database"></i>
                    </div>
                    <h5>CROSS BROWSER SUPPORT</h5>
                    <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet.</p>
                </div>
                <div class="feature last-feature">
                    <div class="feature-icon">
                        <i class="lnr lnr-cog"></i>
                    </div>
                    <h5>EASY TO SETUP</h5>
                    <p>Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet.</p>
                </div>
            </div>
        </div>
    </div><!-- /container -->
</div><!-- / features section image-left -->
<!-- / features section 4col image-left -->


<!-- pricing section 3col -->
<div id="pricing" data-section="pricing">
    <div class="container">
        <div class="page-header first">
            <h2>PRICING</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="pricing-table">
                    <div class="pricing-table-title">
                        <h5 class="pricing-title">SINGLE APPLICATION</h5>
                    </div>
                    <div class="pricing-table-price">
                        <p>
                            <span class="pricing-currency">$</span>
                            <span class="pricing-price">15</span>
                            <span class="pricing-period">/ one-time</span>
                        </p>
                    </div>
                    <div class="pricing-table-content">
                        <ul>
                            <li>SINGLE INSTALLATION</li>
                            <li>FREE LIFETIME UPDATES</li>
                            <li>24/5 EMAIL SUPPORT</li>
                            <li>DESIGN FILES</li>
                            <li>HTML, CSS, SASS AND JS FILES INCLUDED</li>
                            <li>EXTENSIVE DOCUMENTATION</li>
                        </ul>
                        <div class="pricing-table-button">
                            <a href="#my-modal" class="btn btn-primary md" data-toggle="modal">BUY NOW</a>
                        </div>
                    </div>
                </div><!-- / pricing-table -->
            </div>
            <div class="col-md-4">
                <div class="pricing-table">
                    <div class="pricing-table-title">
                        <h5 class="featured pricing-title">MULTIPLE APPLICATIONS</h5>
                    </div>
                    <div class="pricing-table-price">
                        <p>
                            <span class="pricing-currency">$</span>
                            <span class="pricing-price">50</span>
                            <span class="pricing-period">/ one-time</span>
                        </p>
                    </div>
                    <div class="pricing-table-content">
                        <ul>
                            <li>MULTIPLE INSTALLATION</li>
                            <li>FREE LIFETIME UPDATES</li>
                            <li>24/7 EMAIL SUPPORT</li>
                            <li>DESIGN FILES</li>
                            <li>HTML, CSS, SASS AND JS FILES INCLUDED</li>
                            <li>EXTENSIVE DOCUMENTATION</li>
                        </ul>
                        <div class="pricing-table-button">
                            <a href="#my-modal" class="btn btn-primary md" data-toggle="modal">BUY NOW</a>
                        </div>
                    </div>
                </div><!-- / pricing-table -->
            </div>
            <div class="col-md-4">
                <div class="pricing-table">
                    <div class="pricing-table-title">
                        <h5 class="pricing-title">SINGLE</h5>
                    </div>
                    <div class="pricing-table-price">
                        <p>
                            <span class="pricing-currency">$</span>
                            <span class="pricing-price">750</span>
                            <span class="pricing-period">/ one-time</span>
                        </p>
                    </div>
                    <div class="pricing-table-content">
                        <ul>
                            <li>LICENSE, SUBLICENSE, REDISTRIBUTE OR RESELL</li>
                            <li>FREE LIFETIME UPDATES</li>
                            <li>24/7 EMAIL SUPPORT</li>
                            <li>DESIGN FILES</li>
                            <li>HTML, CSS, SASS AND JS FILES INCLUDED</li>
                            <li>EXTENSIVE DOCUMENTATION</li>
                        </ul>
                        <div class="pricing-table-button">
                            <a href="#my-modal" class="btn btn-primary md" data-toggle="modal">BUY NOW</a>
                        </div>
                    </div>
                </div><!-- / pricing-table -->
            </div>
        </div>
    </div><!-- / container -->
</div><!-- / pricing section 3col -->


<!-- parallax section image-left -->
<div id="parallax-section" class="parallax" data-section="testimonials">
    <div class="container">
        <div class="row parallax-section-content-image-left">
            <div class="text-right col-md-6">
            <h2 class="parallax-section-title">PARALLAX SECTION - IMAGE LEFT</h2>
            <h3 class="parallax-section-text">Aenean vel egestas augue, faucibus egestas tortor. Praesent tempor, urna eu imperdiet</h3>
            <a href="#" class="btn btn-success">DOWNLOAD</a>
            </div>
             <div class="image-left col-md-6">
                <img src="images/image-left.png" alt="">
            </div>
        </div>
    </div><!-- / container -->
</div><!-- / parallax section image-left -->


<!-- screenshots 3col -->
<div id="screenshots" data-section="screenshots">
    <div class="container">
        <div class="page-header first">
            <h2>SCREENSHOTS</h2>
        </div>
        <div class="row">
            <div class="screenshots col-sm-4">
                <img src="images/screenshot1.jpg" alt="">
            </div>
            <div class="screenshots col-sm-4">
                <img src="images/screenshot2.jpg" alt="">
            </div> 
            <div class="screenshots col-sm-4">
                <img src="images/screenshot3.jpg" alt="">
            </div> 
        </div>
    </div><!-- / container -->
</div><!-- / screenshots  3col -->


<!-- subscribe -->
<div id="subscribe" data-section="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="contactForm" data-toggle="validator">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" placeholder="ENTER YOUR EMAIL ADDRESS HERE...." required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="form-submit" class="btn btn-info btn-md btn-form-submit">Submit</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- / container -->
</div><!-- /subscribe -->


<!-- footer widgets 3col -->
<div id="footer-widgets" class="no-line" data-section="footer-widgets">
    <div class="container">
        <div class="row">
            <div class="first-footer-widget col-sm-12 col-md-4">
                <img src="images/logo.png" alt="">
                <p>Phasellus pretium interdum dolor vel consequat. Suspendisse porta imperdiet lacus. Morbi pulvinar auctor ipsum eget vehicula. Porttitor at finibus eget, gravida vitae ipsum.</p>
                <p>Curabitur molestie augue et lobortis efficitur. Duis eget finibus nibh.</p>
            </div>
            <div class="second-footer-widget col-sm-12 col-md-4">
                <div class="widget-title">
                    <h3>CONTACT</h3>
                </div>
                <div class="footer-contact-info">
                    <div class="info">
                        <p><i class="lnr lnr-map-marker"></i><span>Miami, S Miami Ave, SW 20th.</span></p>
                    </div>
                    <div class="info">
                        <a href="tel:+0123456789"><i class="lnr lnr-phone-handset"></i><span>+0123 456 789</span></a>
                    </div>
                    <div class="info">
                        <a href="mailto:hello@simplycity.com"><i class="lnr lnr-envelope"></i><span>hello@simplycity.com</span></a>
                    </div>
                </div>
            </div>
            <div class="second-footer-widget col-sm-12 col-md-4">
                <div class="widget-title">
                    <h3>SOCIAL</h3>
                </div>
                <div class="footer-social-widget">
                    <h4>FIND US ON:</h4>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                </div>
            </div>
        </div>
    </div><!-- / container -->
</div><!-- / footer widgets 3col -->


<!-- footer social icons right -->
<footer>
    <div class="container">
        <p class="row">
            <span class="col-xs-12 col-sm-8 left">
            © 2016 <b>SimplyCity</b> - Multipurpose One Page Bootstrap Theme
            </span>
            <span class="col-xs-12 col-sm-4 right">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-pinterest"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
            </span>
        </p>
    </div>
</footer><!-- / footer social icons right -->


<!-- scroll to top -->
<a href="#home" class="scroll-to-top page-scroll"><i class="fa fa-angle-up"></i></a>
<!-- / scroll to top -->
<!---------------------------------------------------------------------------------------------------------------->
<?php $model = new \app\models\Claim(); ?>
<!-- Modal "Buy Now" -->
<div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 150px;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <div id="success"> </div> <!-- For success message -->
                
                <div class="claim-form-wrapper">
                    <?php $form = ActiveForm::begin([
                        'id' => 'claim-form',
                        //'enableAjaxValidation' => true,                        
                        'options' => ['class' => 'claim-form'],
                    ]); ?>

                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- javascript -->
<!-- scripts -->
<!-- nav scroll -->    
<?php //$this->registerJsFile('js/bs_main.js'); ?>
<!-- / nav scroll -->
<!---------------------------------------------------------------------------------------------------------------->
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
