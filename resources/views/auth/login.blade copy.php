{{-- <x-site-layout> --}}

        <!-- Header Start -->
        <div class="container-fluid bg-primary py-5 mb-5 page-header">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h1 class="display-3 text-white animated slideInDown">تسجيل الدخول</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">الدخول</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->


    <!-- Register Section Begin -->
    <section class="register-section classes-page spad">
        <div class="container">
            <div class="classes-page-text">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="register-text">
                            <div class="section-title row text-center pt-3 pb-3" style="display: flex !important;">
                                <h2>سجل دخول الآن</h2>
                            </div>
                            <form action="{{ route('login') }}" method="POST" class="register-form">
                                @csrf
                                <div class="row">

                                    <!-- Email Address -->
                                    <div class="col-lg-12">
                                        <x-input-label for="email" :value="__('البريد الالكتروني')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email"
                                            name="email" :value="old('email')" required autofocus
                                            autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="col-lg-12">
                                        <x-input-label for="password" :value="__('كلمة السر')" />

                                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="current-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mt-2 register-btn rounded">سجل</button>
                                <a  class=" btn btn-secondary register-btn rounded" href="{{ route('register') }}" style="padding-left: 35px; padding-right: 35px; margin-top: 8px">حساب جديد</a>

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="register-pic">
                            <img src="img/register-pic.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Register Section End -->


{{-- </x-site-layout> --}}
