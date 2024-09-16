<x-site-layout>

        <!-- Header Start -->
        <div class="container-fluid bg-primary py-5 mb-5 page-header">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h1 class="display-3 text-white animated slideInDown">حساب جديد</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">حساب جديد</li>
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
                                <h2>حساب جديد الآن</h2>
                            </div>
                            <form action="{{ route('register') }}" method="POST" class="register-form">
                                @csrf
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-lg-6">
                                        <x-input-label for="name" :value="__('الاسم')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text"
                                            name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <!-- Email Address -->
                                    <div class=" col-lg-6">
                                        <x-input-label for="email" :value="__('البريد الالكتروني')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email"
                                            name="email" :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class=" col-lg-6">
                                        <x-input-label for="password" :value="__('كلمة المرور')" />

                                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-lg-6">
                                        <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" />

                                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password" name="password_confirmation" required
                                            autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2 register-btn rounded">إنشاء</button>
                                <p>لديك حساب بالفعل؟</p>
                                <a  class=" btn btn-secondary register-btn rounded" href="{{ route('login') }}" style="padding-left: 35px; padding-right: 35px">دخول</a>
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


</x-site-layout>
