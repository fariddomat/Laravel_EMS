@extends('layouts.site')

@section('styles')
<style>
    .contact-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        direction: rtl;
    }
    .contact-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .contact-container form {
        display: flex;
        flex-direction: column;
    }
    .contact-container .form-group {
        margin-bottom: 15px;
    }
    .contact-container .form-group label {
        margin-bottom: 5px;
    }
    .contact-container .main-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .contact-container input[type="submit"] {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .contact-container input[type="submit"]:hover {
        background-color: #0056b3;
    }
    .contact-container .info {
        margin-top: 20px;
    }
    .contact-container .info h4 {
        margin-bottom: 10px;
    }
    .contact-container .info span,
    .contact-container .info address {
        display: block;
        margin-bottom: 10px;
    }
    .text-danger {
        color: #ff0000;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div class="contact-container" style="padding-top: 100px">
    <h2>اتصل بنا</h2>
    <div class="content">
        <form action="{{ route('sendContact') }}" method="POST">
            @csrf
            <div class="form-group">
                <input
                    class="main-input"
                    type="text"
                    name="name"
                    placeholder="اسمك"
                    value="{{ old('name') }}" required
                />
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <input
                    class="main-input"
                    type="email"
                    name="email"
                    placeholder="بريدك الإلكتروني"
                    value="{{ old('mail') }}" required
                />
                @error('mail')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <textarea
                    class="main-input"
                    name="messag"
                    placeholder="رسالتك" required
                >{{ old('messag') }}</textarea>
                @error('messag')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <input type="submit" value="إرسال الرسالة" />
        </form>
        <div class="info" style="display: flex">
           <div>
            <h4>تواصل معنا</h4>
            <span class="phone">+00 123.456.789</span>
            <span class="phone">+00 123.456.789</span>
           </div>
            <div style="margin-right: 50px">
                <h4>أين نحن</h4>
            <address>
                العنوان الرائع 17<br />حمص 31<br />123-4567-890<br />سوريا
            </address>
            </div>
        </div>
    </div>
</div>
@endsection
