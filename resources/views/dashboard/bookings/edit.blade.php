<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Event</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking Date</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->event->name }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->booking_date->format('Y-m-d H:i') }}</td>
                                <td>{{ ucfirst($booking->status) }}</td>
                                <td class="align-middle">
                                    <!-- Actions (e.g., Edit or Delete) -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
