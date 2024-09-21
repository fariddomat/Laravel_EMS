<!-- resources/views/dashboard/payments/show.blade.php -->

<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <h6 class="text-uppercase text-sm font-weight-bolder opacity-7">Payment Details</h6>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h6>User ID:</h6>
                    <p>{{ $payment->user?->name }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Event ID:</h6>
                    <p>{{ $payment->event?->name }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Amount:</h6>
                    <p>{{ $payment->amount }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Status:</h6>
                    <p>{{ $payment->status }}</p>
                </div>
            </div>
            <a class="btn bg-gradient-dark" href="{{ route('dashboard.payments.index') }}">Back to List</a>
        </div>
    </div>
</x-app-layout>
