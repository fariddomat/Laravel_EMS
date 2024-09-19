<x-app-layout>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body px-0 pb-2">
                <div class="container">
                    <h1>Packages</h1>
                    <a href="{{ route('dashboard.packages.create') }}" class="btn btn-primary">Create Package</a>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Deadline</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                                <tr>
                                    <td>{{ $package->name }}</td>
                                    <td>{{ $package->description }}</td>
                                    <td>{{ $package->price }}</td>
                                    <td>{{ $package->deadline }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.packages.show', $package) }}"
                                            class="btn btn-info">View</a>
                                        <a href="{{ route('dashboard.packages.edit', $package) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('dashboard.packages.destroy', $package) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
