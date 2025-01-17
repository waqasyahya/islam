@extends('HomeScreen.Header-Layout')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>About</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <!-- Favicons -->
  <link href="/image/WIthColor_logo.png" rel="icon">
  <link href="/image/WIthColor_logo.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  {{-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
<style>
   .our-team{
      border: 1px solid #dedede;
      text-align: center;
      color: #006d74;
      width: 300px;
      overflow: hidden;
      transition: all 0.3s ease 0s;
  }
  .our-team:hover{
    background:#006d74;
      color: #fff;
  }
  .our-team .pic{ position: relative; }
  .our-team .pic img{
      width: 100%;
      height: 285px;
      transition: all 0.3s ease 0s;
  }
  .our-team:hover .pic img{ transform: translateY(-20px); }
  .our-team .social{
      width: 20%;
      height: 100%;
      background:#006d74;
      padding: 20px 0;
      margin: 0;
      list-style: none;
      position: absolute;
      top: 0;
      left: -50%;
      transition: all 0.5s ease 0s;
  }
  .our-team:hover .social{ left: 0; }
  .our-team .social li{ display: block; }
  .our-team .social li a{
      display: block;
      padding: 10px 0;
      font-size: 20px;
      color: #fff;
      transition: all 0.5s ease 0s;
  }
  .our-team .social li a:hover{ color: #ff9b19; }
  .our-team .team-content{ padding: 25px 0; }
  .our-team .title{
      font-size: 20px;
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin: 0 0 10px 0;
  }
  .our-team .post{
      display: block;
      font-size: 15px;
      text-transform: capitalize;
  }
  @media only screen and (max-width: 990px){
      .our-team{ margin-bottom: 30px; }
  }





</style>
</head>

<body class="index-page">



  <main class="main">





  <script>
    AOS.init();

  </script>
  <div class="" style="margin-top: -20px;"></div>
    <div data-aos="fade-in"  style="max-width: 100%; width: 100%;">

    <div class="about-pageheading-section" style="background: linear-gradient(to top, #006d74, #02904c);height: auto; width: 100%; margin-top:70px; text-align: center; display: flex; align-items: center; justify-content: center; padding: 
    0px 5px;">
        <span style="display: flex;  font-family: 'Readex Pro', sans-serif; flex-direction: column; align-items: center; font-weight: 400; font-size: 67px; color: white; line-height: 80px; padding-bottom: 40px; padding-top: 80px;" class="all-youneed-to-know-about-islam Readexpro1">
            All You Need To<br>
            <div style="font-size: 72px; font-weight: 500;font-family: 'Readex Pro', sans-serif;" class="about-page-main-heading Readexpro1">Know About Islame</div>
            <span  style="font-size: 22px; font-weight: 300; font-family: 'Readex Pro', sans-serif;" class="about-page-main-heading Readexpro1">  Learn everything there is to know about the dedicated team behind the Islame app and its successes</span>
        </span>
    </div>
    
    </div> 

  
  
    <section id="features-details" class="features-details section">

      <div class="container">
        <h1>waqas</h1>
        <div class="row gy-4 justify-content-between features-item">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/features-1.jpg" class="img-fluid" alt="">
          </div>

          <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Corporis temporibus maiores provident</h3>
              <p>
                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
              </p>
              <a href="#" class="btn more-btn">Learn More</a>
            </div>
          </div>

        </div><!-- Features Item -->
        
        <h1>waqas</h1>
        <div class="row gy-4 justify-content-between features-item">

          <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">

            <div class="content">
              <h3>Neque ipsum omnis sapiente quod quia dicta</h3>
              <p>
                Quidem qui dolore incidunt aut. In assumenda harum id iusto lorena plasico mares
              </p>
              <ul>
                <li><i class="bi bi-easel flex-shrink-0"></i> Et corporis ea eveniet ducimus.</li>
                <li><i class="bi bi-patch-check flex-shrink-0"></i> Exercitationem dolorem sapiente.</li>
                <li><i class="bi bi-brightness-high flex-shrink-0"></i> Veniam quia modi magnam.</li>
              </ul>
              <p></p>
              <a href="#" class="btn more-btn">Learn More</a>
            </div>

          </div>

          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/features-2.jpg" class="img-fluid" alt="">
          </div>

        </div><!-- Features Item -->
        <h1>waqas</h1>
        <div class="row gy-4 justify-content-between features-item">

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <img src="assets/img/features-1.jpg" class="img-fluid" alt="">
            </div>
  
            <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
              <div class="content">
                <h3>Corporis temporibus maiores provident</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                </p>
                <a href="#" class="btn more-btn">Learn More</a>
              </div>
            </div>
  
          </div><!-- Features Item -->
          <h1>waqas</h1>
          <div class="row gy-4 justify-content-between features-item">

            <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
  
              <div class="content">
                <h3>Neque ipsum omnis sapiente quod quia dicta</h3>
                <p>
                  Quidem qui dolore incidunt aut. In assumenda harum id iusto lorena plasico mares
                </p>
                <ul>
                  <li><i class="bi bi-easel flex-shrink-0"></i> Et corporis ea eveniet ducimus.</li>
                  <li><i class="bi bi-patch-check flex-shrink-0"></i> Exercitationem dolorem sapiente.</li>
                  <li><i class="bi bi-brightness-high flex-shrink-0"></i> Veniam quia modi magnam.</li>
                </ul>
                <p></p>
                <a href="#" class="btn more-btn">Learn More</a>
              </div>
  
            </div>
  
            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/features-2.jpg" class="img-fluid" alt="">
            </div>
  
          </div><!-- Features Item -->

      </div>
      


    <img class="img  " src="/image/topLine.jpg" style="width: 100%; margin-top: 50px;">












<div class="" style="width:100%;   background: linear-gradient(to bottom, #006d74, #02904c); height:500px">
  <div class="container">

    <div class="row gy-4 justify-content-between features-item">

      <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <img src="assets/img/features-1.jpg" class="img-fluid" alt="">
      </div>

      <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
        <div class="content">
          <h3>Corporis temporibus maiores provident</h3>
          <p>
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
          </p>
          <a href="#" class="btn more-btn">Learn More</a>
        </div>
      </div>

    </div><!-- Features Item -->

</div>
</section>
</main>


{{-- <img class="img  " src="/image/topLine.jpg" style="width: 100%; margin-top: 50px;"> --}}



<div class="" style="  background: linear-gradient(to bottom, #006d74, #02904c); width:100%; height:30px; margin-bottom:-100px"></div>
<div class="container-fluid" style="margin-top:70px; ">
  <div class="row" style="width: 100%;">
      <div class=" col-3" style="margin-right: -19px;">
          <div class="our-team" >
              <div class="pic">
                  <img src="/image/WAQAS YAHYA.jpg">
                  <ul class="social">
                      <li><a href="#" class="fab fa-facebook"></a></li>
                      <li><a href="#" class="fab fa-google-plus"></a></li>
                      <li><a href="#" class="fab fa-instagram"></a></li>
                      <li><a href="#" class="fab fa-linkedin"></a></li>
                  </ul>
              </div>
              <div class="team-content">
                  <h3 class="title">Williamson</h3>
                  <span class="post">Web Developer</span>
              </div>
          </div>
      </div>
      <div class=" col-3" style="margin-right: 0px;">
          <div class="our-team">
              <div class="pic">
                <img src="/image/WAQAS YAHYA.jpg">
                  <ul class="social">
                      <li><a href="#" class="fab fa-facebook"></a></li>
                      <li><a href="#" class="fab fa-google-plus"></a></li>
                      <li><a href="#" class="fab fa-instagram"></a></li>
                      <li><a href="#" class="fab fa-linkedin"></a></li>
                  </ul>
              </div>
              <div class="team-content">
                  <h3 class="title">Kristiana</h3>
                  <span class="post">Web Designer</span>
              </div>
          </div>
      </div>
      <div class=" col-3" style="margin-right: -4px;">
        <div class="our-team">
            <div class="pic">
              <img src="/image/WAQAS YAHYA.jpg">
                <ul class="social">
                    <li><a href="#" class="fab fa-facebook"></a></li>
                    <li><a href="#" class="fab fa-google-plus"></a></li>
                    <li><a href="#" class="fab fa-instagram"></a></li>
                    <li><a href="#" class="fab fa-linkedin"></a></li>
                </ul>
            </div>
            <div class="team-content">
                <h3 class="title">Kristiana</h3>
                <span class="post">Web Designer</span>
            </div>
        </div>
    </div>
    <div class=" col-3" style="margin-right: 10px;">
      <div class="our-team">
          <div class="pic">
            <img src="/image/WAQAS YAHYA.jpg">
              <ul class="social">
                  <li><a href="#" class="fab fa-facebook"></a></li>
                  <li><a href="#" class="fab fa-google-plus"></a></li>
                  <li><a href="#" class="fab fa-instagram"></a></li>
                  <li><a href="#" class="fab fa-linkedin"></a></li>
              </ul>
          </div>
          <div class="team-content">
              <h3 class="title">Kristiana</h3>
              <span class="post">Web Designer</span>
          </div>
      </div>
  </div>
  </div>
</div>
<div class="" style="  background: linear-gradient(to bottom, #006d74, #02904c); width:100%; height:30px; margin-top: -30px"></div>





  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  @include('HomeScreen.Footer-Layout')
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>