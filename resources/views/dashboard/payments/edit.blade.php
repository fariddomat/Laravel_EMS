<!-- resources/views/dashboard/payments/edit.blade.php -->

<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <h6 class="text-uppercase text-sm font-weight-bolder opacity-7">Edit Payment</h6>
            </div>
            <form action="{{ route('dashboard.payments.update', $payment) }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">User ID</label>
                        <input name="user_id" type="number" class="form-control border border-2 p-2" value="{{ old('user_id', $payment->user_id) }}">
                        @error('user_id')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Event ID</label>
                        <input name="event_id" type="number" class="form-control border border-2 p-2" value="{{ old('event_id', $payment->event_id) }}">
                        @error('event_id')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Amount</label>
                        <input name="amount" type="text" class="form-control border border-2 p-2" value="{{ old('amount', $payment->amount) }}">
                        @error('amount')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control border border-2 p-2">
                            <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status', $payment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="failed" {{ old('status', $payment->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                        @error('status')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn bg-gradient-dark">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
