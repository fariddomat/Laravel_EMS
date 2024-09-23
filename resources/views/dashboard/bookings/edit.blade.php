<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-md-12">
                    <h4>Edit Booking</h4>
                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Event Information -->
                        <div class="mb-3">
                            <label for="event" class="form-label">Event</label>
                            <input type="text" id="event" class="form-control" value="{{ $booking->event->name }}" disabled>
                        </div>

                        <!-- User Information -->
                        <div class="mb-3">
                            <label for="user" class="form-label">User</label>
                            <input type="text" id="user" class="form-control" value="{{ $booking->user->name }}" disabled>
                        </div>

                        <!-- Booking Date -->
                        <div class="mb-3">
                            <label for="booking_date" class="form-label">Booking Date</label>
                            <input type="text" id="booking_date" class="form-control" value="{{ $booking->booking_date->format('Y-m-d H:i') }}" disabled>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <!-- Save Button -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
