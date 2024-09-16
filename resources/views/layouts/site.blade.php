<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event</title>

    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="{{ asset('home/assets/css files/fontawesome-free-6.5.1-web/css/all.min.css') }}"
    />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&family=Rubik:ital,wght@0,300..900;1,300..900&family=Vazirmatn:wght@100..900&display=swap"
      rel="stylesheet"
    />

    <!-- card slider -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />

    <!-- css file -->
    <link rel="stylesheet" href="{{ asset('home/assets/css files/style.css') }}" />
    @yield('styles')
  </head>
  <body>
    <header>
      <nav class="navbar flex">
        <div class="logo flex">
          <div class="navbar-img">
            <img src="{{ asset('home/assets/images/logo.png') }}" alt="logo" />
          </div>
          <h3 class="flex">
            <span> الوساطة العقارية </span>
            <span> الذكية </span>
          </h3>
        </div>

        <ul class="navbar-items flex">
          <li><a class="item-active" href="{{ route('home') }}">الرئيسية</a></li>
          <li><a href="{{ route('categories') }}">العقارات</a></li>
          <li><a href="#team">من نحن ؟</a></li>
          <li><a href="{{ route('contact') }}">تواصل معنا </a></li>
        </ul>
        <div class="account">
          <a href="{{ route('login') }}">
            <i class="fa-regular fa-user"></i>
           @auth
                لوحة التحكم
               @else
               تسجيل الدخول
           @endauth
          </a>
        </div>
      </nav>

    </header>
    <!-- end of header -->

    @yield('content')
    <!-- start of footer -->
    <footer id="contact">
      <div class="footer-content flex container">
        <div class="logo flex">
          <div class="footer-img">
            <img src="{{ asset('home/assets/images/logo.png') }}" alt="logo" />
          </div>
          <h3 class="flex">
            <span> الوساطة العقارية </span>
            <span> الذكية </span>
          </h3>
        </div>
        <ul class="info">
          <li><a href="#">أرقام مفيدة</a></li>
          <li><a href="#"> توصيات</a></li>
          <li><a href="#"> اسئلة متكررة</a></li>
        </ul>
        <ul class="info">
          <li><a href="#"> السجل التجاري</a></li>
          <li><a href="#"> الاستثمار</a></li>
          <li><a href="#"> سياسة الخصوصية</a></li>
        </ul>
      </div>
      <div class="footer-contact flex">
        <div class="email-link">
          <a href="#">realestateAI@gmail.com</a>
          <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="contact-links">
          <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        </div>
      </div>
    </footer>
    <!-- end of footer -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="{{ asset('home/assets/JS files/script.js') }}"></script>
  </body>
</html>
