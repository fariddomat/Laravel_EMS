<x-app-layout>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body px-0 pb-2">
                <div class="container">
                    <h1>{{ $package->name }}</h1>
                    <p>{{ $package->description }}</p>
                    <p>Price: {{ $package->price }}</p>
                    <p>Deadline: {{ $package->deadline }}</p>

                    <h3>Included Events:</h3>
                    <ul>
                        @foreach ($package->events as $event)
                            <li>{{ $event->name }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('dashboard.packages.index') }}" class="btn btn-secondary">Back to Packages</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
