@extends('layouts.site')
@section('styles')
<style>
    /* Custom styles for order and favorite buttons */
    .btn-custom {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 10px 5px;
        text-decoration: none;
    }

    .btn-primary-custom {
        background-color: #007bff;
        color: white;
    }

    .btn-primary-custom:hover {
        background-color: #0056b3;
    }

    .btn-secondary-custom {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary-custom:hover {
        background-color: #565e64;
    }

    /* Custom styles for comment section */
    .comments-section {
        margin-top: 30px;
    }

    .comments-section h4 {
        margin-bottom: 20px;
    }

    .comment {
        border-bottom: 1px solid #ccc;
        padding: 10px 0;
    }

    .comment p {
        margin: 5px 0;
    }

    .comment small {
        display: block;
        color: #777;
    }

    .add-comment {
        margin-top: 20px;
    }

    .add-comment h4 {
        margin-bottom: 10px;
    }

    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
    }

    .btn-success-custom {
        background-color: #28a745;
        color: white;
    }

    .btn-success-custom:hover {
        background-color: #218838;
    }
</style>
@endsection
@section('content')
<main>
    <div>
        <ul class="breadcrumb">
            <li><a href="#">{{ $property->type }}</a></li>
            <li><a href="#">منزل</a></li>
            <li><a href="#">{{ $property->address }}</a></li>
            <li class="slash"><a href="#">{{ $property->direction }}</a></li>
            <li class="slash"><a href="#">{{ $property->name }}</a></li>
        </ul>
    </div>


    <!-- Order and Favorite Buttons -->
    <div class="container" style="display: flex;">
       @auth

       <a href="{{ route('order.form', $property) }}" class="btn-custom btn-primary-custom">أحجز الشقة الآن</a>

            @if (!$isFavorite)
            <form action="{{ route('addToFavorite', $property) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn-custom btn-secondary-custom">إضافة إلى المفضلة</button>
            </form>

            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-custom btn-primary-custom">سجل الدخول الآن</a>

       @endauth
    </div>
    <!-- home-gallery-section -->
    <section class="house-gallery container">
        @foreach($propertyImages as $image)
        <div class="gallery-box">
            <img src="{{ asset($image->img) }}" alt="{{ $property->name }}">
            <div class="overlay">
                <img src="{{ asset('home') }}/assets/images/gallery logo.png" alt="logo">
            </div>
        </div>
        @endforeach
    </section>
    <!-- end of home-gallery-section -->

    <!-- about-section -->
    <section class="container">
        <div class="about">
            <div class="about-overview flex border-bottom">
                <h4>
                    لمحة عامة
                </h4>
                <div>
                    <span>معرف العقار :</span>
                    <span>{{ $property->id }}</span>
                </div>
            </div>
            <div class="about-details flex">
                <div>
                    <h5>سجل عقاري</h5>
                    <p>نوع الملكية</p>
                </div>
                <div class="details-content flex">
                    <div class="flex">
                        <div class="flex">
                            <img src="{{ asset('home') }}/assets/images/bed.png" alt="bed icon">
                            <span>{{ $property->rooms }}</span>
                        </div>
                        <p>غرفة نوم</p>
                    </div>
                    <div class="flex">
                        <div class="flex">
                            <img src="{{ asset('home') }}/assets/images/Shower.png" alt="shower icon">
                            <span>1</span>
                        </div>
                        <p>حمام</p>
                    </div>
                    <div class="area flex">
                        <div class="flex">
                            <img src="{{ asset('home') }}/assets/images/triangle.png" alt="area icon">
                            <span>{{ $property->area }} متر مربع</span>
                        </div>
                        <p>المساحة</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="about description">
            <h4>الوصف</h4>
            <p>{{ $property->description }}</p>
            <h4>المواصفات :</h4>
            <ul>
                <li> المساحة : {{ $property->area }} متر مربع</li>
                <li> غرف نوم : {{ $property->rooms }}</li>
                <li> مطبخ</li>
                <li> حمام : 1</li>
            </ul>
            <p class="pd">السعر: <span>{{ number_format($property->price, 2) }}</span> ل.س</p>
            <p class="pd">رسوم الوساطة: <span>1.5%</span></p>
            <p class="pd">للمشاهدة ومزيد من المعلومات اتصل على: <span>+963 998268410</span></p>
            <p class="note pd">
                <span>ملاحظة</span> : يوجد عرض في حالة شراء هذه الشقة قبل شهر أيار تحصل على هدية تركيب نظام الطاقة الشمسية مجانًا.
            </p>
            <p>لا تدفع ثمن السفر إلى أوروبا، فقد وفرنا لك أوروبا في حومص :)</p>
        </div>
    </section>
    <!-- end of about-section -->

     <!-- comments-section -->
     <section class="container  comments-section">
        <div class="comments">
            <h4>التعليقات</h4>
            @foreach($comments as $comment)
            <div class="comment">
                <p>{{ $comment->comment }}</p>
                <small>بواسطة {{ $comment->user->name }} ||  منذ {{ $comment->created_at->diffForHumans() }}</small>
            </div>
            @endforeach
        </div>

       @auth
           <div class="add-comment">
            <h4>إضافة تعليق</h4>
            <form action="{{ route('comment', $property) }}" method="POST">
                @csrf

                <div class="form-group">
                    <textarea name="comment" rows="4" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn-custom btn-success-custom">إضافة تعليق</button>
            </form>
        </div>
        @else
        <a href="{{ route('login') }}" class="btn-custom btn-primary-custom">سجل دخول لإضافة تعليق</a>

       @endauth

    </section>
    <!-- end of comments-section -->
</main>
@endsection
