@extends('layouts.site')

@section('styles')
<style>
    /* Custom styles for order form */
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
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
<main style="padding-top: 50px">
    <div class="container" style="text-align: right;">
        <h1>إتمام الطلب للعقار {{ $property->name }}</h1>
        <form action="{{ route('order.process', $property) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">رسالة (اختياري)</label>
                <textarea name="message" id="message" rows="4" class="form-control">{{ old('message') }}</textarea>
                @error('message')
                    <p class='text-danger'>{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn-custom btn-primary-custom">إتمام الطلب</button>
        </form>
    </div>
</main>
@endsection
