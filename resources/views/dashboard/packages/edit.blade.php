<x-app-layout>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body px-0 pb-2">
                <div class="container">
                    <h1>Edit Package</h1>

                    <form action="{{ route('dashboard.packages.update', $package) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Package Name</label>
                            <input type="text" name="name" class="form-control border border-2 p-2" value="{{ $package->name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control border border-2 p-2" required>{{ $package->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control border border-2 p-2" value="{{ $package->price }}"
                                step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" id="deadline" name="deadline" class="form-control border border-2 p-2"
                                value="{{ $package->deadline->format('Y-m-d') }}" required>
                        </div>
                        <script>
                            // Get the input element
                            const deadlineInput = document.getElementById('deadline');
                            
                            // Create a new date object for tomorrow
                            const today = new Date();
                            const tomorrow = new Date(today);
                            tomorrow.setDate(today.getDate() + 1);
                            
                            // Format the date to YYYY-MM-DD
                            const year = tomorrow.getFullYear();
                            const month = String(tomorrow.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
                            const day = String(tomorrow.getDate()).padStart(2, '0');
                            
                            // Set the min attribute to tomorrow's date
                            deadlineInput.min = `${year}-${month}-${day}`;
                        </script>
                        
                        <div class="mb-3">
                            <label for="event_ids" class="form-label">Select Events</label>
                            <select name="event_ids[]" class="form-select border border-2 p-2" multiple required>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}"
                                        {{ $package->events->contains($event->id) ? 'selected' : '' }}>
                                        {{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Package</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
