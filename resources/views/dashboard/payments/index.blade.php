<!-- resources/views/dashboard/payments/index.blade.php -->

<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <h6 class="text-uppercase text-sm font-weight-bolder opacity-7">Payments</h6>
                <a class="btn bg-gradient-dark mb-0" href="{{ route('dashboard.payments.create') }}">
                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Payment
                </a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Event ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->user_id }}</td>
                                <td>{{ $payment->event_id }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>
                                    <a class="btn btn-info btn-link" href="{{ route('dashboard.payments.show', $payment) }}">View</a>
                                    <a class="btn btn-success btn-link" href="{{ route('dashboard.payments.edit', $payment) }}">Edit</a>
                                    <form action="{{ route('dashboard.payments.destroy', $payment) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-link">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
