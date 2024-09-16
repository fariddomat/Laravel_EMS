@extends('layouts.site')

@section('styles')
<style>
    /* Custom styles for checkout page */
    .container {
        text-align: right;
    }
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
</style>
@endsection

@section('content')
<main style="padding-top: 150px">
    <div class="container">
        <h1>عملية الشراء</h1>
        <p style="margin-top: 25px; margin-bottom: 25px">شكراً لطلبك! الرجاء متابعة عملية الدفع.</p>
        <!-- Add dummy checkout details here -->
        <a href="{{ route('home') }}" class="btn-custom btn-primary-custom">العودة إلى الصفحة الرئيسية</a>
    </div>
</main>
@endsection
