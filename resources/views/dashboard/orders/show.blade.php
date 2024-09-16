@section('styles')
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/r-3.0.1/rr-1.5.0/datatables.min.css" rel="stylesheet">
    <style>
        div.dt-container div.dt-search input {
            border: 1px solid #dee2e6 !important;
        }
    </style>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/r-3.0.1/rr-1.5.0/datatables.min.js" defer></script>

    <script></script>
@endsection

<x-app-layout>
    <div class="">
        <!-- Navbar -->
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="col-6 text-white text-capitalize ps-3">
                                    تفاصيل الطلب رقم {{ $order->id }}</h6>
                            </div>

                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0" style="margin: 25px">
                                <table id="Table" class="table align-items-center mb-0">

                                    <tr>
                                        <th>العقار:</th>
                                        <td>{{ $order->property->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>المستخدم:</th>
                                        <td>{{ $order->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>الرسالة:</th>
                                        <td>{{ $order->message }}</td>
                                    </tr>
                                    <tr>
                                        <th>الحالة:</th>
                                        <td>{{ $order->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>الرد:</th>
                                        <td>{{ $order->reply }}</td>
                                    </tr>
                                </table>

                                <form action="{{ route('dashboard.orders.update', $order->id) }}" method="POST" s>
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="status">الحالة</label>
                                        <select name="status" id="status" class="form-control  border border-2 p-2">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                معلق</option>
                                            <option value="approved"
                                                {{ $order->status == 'approved' ? 'selected' : '' }}>موافق عليه</option>
                                            <option value="rejected"
                                                {{ $order->status == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="reply">الرد</label>
                                        <textarea name="reply" id="reply" rows="4" class="form-control  border border-2 p-2">{{ $order->reply }}</textarea>
                                    </div>

                                    @if (!auth()->user()->hasRole('user'))
                                        <button type="submit" class="btn btn-success">تحديث الطلب</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
