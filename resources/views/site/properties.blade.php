@extends('layouts.site')

@section('styles')
    <link rel="stylesheet" href="{{ asset('home') }}/assets/css files/houses.css" />
@endsection

@section('content')
    <div class="boxes" style="padding-top: 35px; padding-bottom: 75px">
        @foreach ($properties as $property)
            <div class="box">
                <div class="card" style="width: 100% !important;">
                <div class="card-img">
                    <img src="{{ asset($property->img) }}" alt="Two-storey house" />
                    <span>{{ $property->type }}</span>
                </div>

                </div>
                <div class="text_info">
                    <h3><i class="fas fa-home"></i>{{ $property->name }}</h3>
                    <p>{{ $property->description }}</p>
                </div>

                <div class="price">{{ $property->price }} ل.س</div>
                <div class="text_info" style="text-align: center">
                    <a href="{{ route('property', $property) }}"
                        style="margin: 0 10px 20px;
                        width: 125px;
                        height: 30px;
                        text-transform: uppercase;
                        border: none;
                        border-radius: 6px;
                        background-color: gold;
                        color: white;
                        font-weight: 600;
                        cursor: pointer;  padding: 7px 40px;">تفاصيل</a>
                </div>
            </div>

    @endforeach
    </div>
    {{ $properties->links() }}
@endsection
