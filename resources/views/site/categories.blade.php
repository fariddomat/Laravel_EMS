@extends('layouts.site')

@section('styles')
<link rel="stylesheet" href="{{ asset('home/assets/css files/houses.css') }}" />
@endsection

@section('content')
<div class="boxes">
    @foreach($categories as $category)
    <div class="box">
        <img src="{{ asset($category->img) }}" alt="{{ $category->name }}" />
        <div class="text_info">
            <h3><i class="fas fa-home"></i>{{ $category->name }}</h3>
            <p>{{ $category->description }}</p>
        </div>
       <div class="text_info" style="text-align: center">
        <a href="{{ route('properties', $category) }}" style="margin: 0 10px 20px;
  width: 125px;
  height: 30px;
  text-transform: uppercase;
  border: none;
  border-radius: 6px;
  background-color: gold;
  color: white;
  font-weight: 600;
  cursor: pointer;  padding: 7px 40px;">المزيد</a></div>
    </div>
    @endforeach
</div>
@endsection
