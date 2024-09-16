@extends('layouts.site')

@section('content')
<div id="home" class="hero flex">
    <div class="hero-content">
        <h1>
            <span>ابحث</span>
            <span>عن المنزل المثالي</span>
            <span>الذي تريده ..!</span>
        </h1>
        <p>
            نضمن ان يقدم لك موقعنا تجربة مميزة بأسعار منافسة، أولويتنا هي راحة
            العملاء.
        </p>
        <div class="stats flex">
            <div>
                <i class="fa-solid fa-plus"></i>
                <span class="counter" data-target="{{ $totalClients }}">0</span>
                <div class="flex">
                    <p>عميل</p>
                    <p>سعيد</p>
                </div>
            </div>
            <div>
                <i class="fa-solid fa-plus"></i>
                <span class="counter" data-target="{{ $totalProperties }}">0</span>
                <div class="flex">
                    <p>عقار</p>
                    <p>مميز</p>
                </div>
            </div>
            <div>
                <i class="fa-solid fa-plus"></i>
                <span class="counter" data-target="{{ $totalOwners }}">0</span>
                <div class="flex">
                    <p>وكيل</p>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-img">
        <img src="{{ asset('home/assets/images/2.png') }}" alt="house" />
    </div>

    <div class="bar">
        <form action="{{ route('search') }}" method="GET" class="bar-list flex">
            <ul class="bar-list flex">
                <li>
                    <input type="radio" name="type" value="all" checked> الجميع
                </li>
                <li>
                    <input type="radio" name="type" value="بيع"> للبيع
                </li>
                <li>
                    <input type="radio" name="type" value="آجار"> للآجار
                </li>
            </ul>
            <div class="bar-inputs flex">
                <div class="input-wrapper">
                    <input type="text" name="location" placeholder="جميع المناطق" />
                    <div class="control">
                        <i class="fa-solid fa-chevron-up"></i>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
                <div class="input-wrapper">
                    <select name="category"  id="" style="height: 100%; padding-right: 10px;">
                        <option value="">كل الأنواع</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-wrapper">
                    <input class="wdth" type="number" name="rooms" placeholder="عدد الغرف" />
                    <div class="control">

                    </div>
                </div>
                <button type="submit" class="search-btn">بحث</button>
            </div>
        </form>
    </div>

</div>
<!-- start of main -->
<main class="bg">
    <section id="overview" class="overview container flex">
        <div class="overview-text">
            <h3 class="title">نبذة عامة</h3>
            <p class="desc">
                موقع الوساطة العقارية الذكية هو موقع تم ايجاده لخدمة العملاء وتسهيل
                عملية الشراء و البيع، من خلال موقعنا تستطيع العثور على منزلك المناسب
                بالسعر الأفضل، كما تستطيع عرض عقاراتك للبيع مقابل عمولة بسيطة، نضمن
                لك جودة الخدمة وسرعتها
            </p>
        </div>
        <div class="overview-gallery flex">
            <div class="box">
                <img src="{{ asset('home/assets/images/first-section2.png') }}" alt="#" />
                <img src="{{ asset('home/assets/images/first-section1.png') }}" alt="#" />
            </div>
            <div class="box">
                <img src="{{ asset('home/assets/images/first-section3.png') }}" alt="houses" />
            </div>
            <img class="first circle" src="{{ asset('home/assets/images/Ellipse 19.png') }}" alt="circle1" />
            <img class="second circle" src="{{ asset('home/assets/images/Ellipse 19.png') }}" alt="circle1" />
            <img class="third circle" src="{{ asset('home/assets/images/Ellipse 19.png') }}" alt="circle1" />
        </div>
    </section>

    <!-- start of the second section -->
    <section class="cards-slider-section container">
        <div class="section-header">
            <h3 class="title">التوصيات</h3>
            <p class="desc">
                نقدم لكم أفضل البيوت بأرخص الأسعار بناءً على تجارب عملائنا و تحليلنا
                للسوق.
            </p>
        </div>
        <div class="swiper-container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($properties as $property)
                    <div class="swiper-slide">
                        <div class="card" >
                            <div class="card-img">
                                <img src="{{ asset($property->img) }}" alt="Two-storey house" />
                                <span>{{ $property->type }}</span>
                            </div>
                            <div class="card-content">
                                <p>{{ $property->price }} ل.س</p>
                                <h4>{{ $property->name }}</h4>
                                <div class="card-location flex">
                                    <span>{{ $property->address }}</span>
                                    <img src="{{ asset('home/assets/images/locationIcon.png') }}" alt="location dot" />
                                </div>
                                <div class="details flex">
                                    <div class="flex">
                                       <span>{{ $property->direction }}</span>
                                    </div>
                                    <div class="flex">
                                        <img src="{{ asset('home/assets/images/bed.png') }}" alt="bed icon" />
                                        <span>{{ $property->rooms }}</span>
                                    </div>
                                </div>
                                <div class="area flex">
                                    <img src="{{ asset('home/assets/images/triangle.png') }}" alt="ruler" />
                                    <span>{{ $property->area }} متر مربع</span>
                                </div>
                                <div class="card-btn flex">
                                    <a href="{{ route('property', $property) }}">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-scrollbar"></div>
        </div>
        <div class="btn-box">
            <button class="btn-effect">المزيد</button>
        </div>
    </section>

    <!-- end of second section -->

    <!-- start of third section -->
    <section id="team" class="our-team container">
        <div class="section-header">
            <h3 class="title">قابل وكلائنا</h3>
            <p class="desc flex">
                <span>
                    لقد قام فريقنا باختيار مجموعة من أفضل العقارات السكنية والتجارية
                    من حيث البناء والسعر للشراء أو الإيجار.
                </span>
                <span> معًا سنجد منزل أحلامك...! </span>
            </p>
        </div>
        <div class="team-slider">
            <div class="slider-container">
                <div class="wrapper">
                    @foreach ($owners as $owner)
                    <div class="team-item">
                        <img src="{{ asset($owner->image) }}" alt="team-member" />
                        <h5>{{ $owner->name }}</h5>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- end of third section -->

    <!-- start of fourth section -->
    <section id="services" class="container">
        <div class="section-header">
            <h3 class="title">خدماتنا</h3>
        </div>
        <div class="services flex">
            <div class="services-item flex">
                <div class="services-icon">
                    <img src="{{ asset('home/assets/images/Handshake.png') }}" alt="hand-shake" />
                </div>
                <div class="services-text">
                    <h5>خدمات الوكالة</h5>
                    <p>
                        تقدم شركة الوساطة العقارية الذكية خدمات الوكالة للملاك أو
                        المستثمرين أو المؤسسات أو الشركات تحت شعار موحد السرعة والثقة في
                        التعامل.
                    </p>
                </div>
            </div>
            <div class="services-item flex">
                <div>
                    <img src="{{ asset('home/assets/images/Property Growth.png') }}" alt="Property" />
                </div>
                <div class="services-text">
                    <h5>إدارة الممتلكات</h5>
                    <p>
                        نحن نقدم حزمة الإدارة الكاملة، حيث يمكنك نقل ملكيتك إلى استثمار
                        دون أي متاعب.
                    </p>
                </div>
            </div>
            <div class="services-item flex">
                <div>
                    <img src="{{ asset('home/assets/images/Market Research.png') }}" alt="market-research" />
                </div>
                <div class="services-text">
                    <h5>أبحاث السوق</h5>
                    <p>
                        يقوم قسم أبحاث السوق في شركة الوساطة العقارية الذكية بمراقبة سوق
                        العقارات عن كثب، والبقاء على اتصال بالظروف السائدة وتحديد
                        الاتجاهات.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end of fourth section -->
</main>
<!-- end of main -->
@endsection
