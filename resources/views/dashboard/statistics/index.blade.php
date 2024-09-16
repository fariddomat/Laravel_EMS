<x-app-layout>

    @section('styles')
    <style>
        .statistics-container {
            direction: rtl;
            margin-top: 50px;
        }
        .card {
            margin: 15px;
            border: 1px solid #007bff;
        }
        .card-title {
            color: #007bff;
        }
        .card-body {
            background-color: #f8f9fa;
        }
        .card-text {
            font-size: 1.5rem;
            color: #343a40;
        }
    </style>
    @endsection

    <div class="container statistics-container">
        <h1 class="text-center">الإحصائيات</h1>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي المستخدمين</h5>
                        <p class="card-text">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">المستخدمين المفعلين</h5>
                        <p class="card-text">{{ $activeUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">المستخدمين غير المفعلين</h5>
                        <p class="card-text">{{ $inactiveUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي العقارات</h5>
                        <p class="card-text">{{ $totalProperties }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الطلبات</h5>
                        <p class="card-text">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
