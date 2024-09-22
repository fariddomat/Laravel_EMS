<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <form action="{{ route('dashboard.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control border border-2 p-2"
                                value="{{ old('name', $event->name) }}">
                            @error('name')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Price</label>
                            <input name="price" type="text" class="form-control border border-2 p-2"
                                value="{{ old('price', $event->price) }}">
                            @error('price')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control border border-2 p-2" cols="30" rows="10">{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control border border-2 p-2">
                                <option value="pending" @if ($event->status =='pending')
                                    selected
                                @endif>pending</option>
                                <option value="accepted" @if ($event->status =='accepted')
                                    selected
                                @endif>accept</option>
                                <option value="canceled" @if ($event->status =='canceled')
                                    selected
                                @endif>canceled</option>
                            </select>
                            @error('status')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Company</label>
                            <select name="company_id" class="form-control border border-2 p-2">
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id', $event->company_id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-control border border-2 p-2">
                                <option value="person" {{ old('type', $event->type) == 'person' ? 'selected' : '' }}>Person</option>
                                <option value="website" {{ old('type', $event->type) == 'website' ? 'selected' : '' }}>Website</option>
                            </select>
                            @error('type')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Images</label>
                            <input name="images[]" type="file" multiple class="form-control border border-2 p-2">
                            @error('images')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Videos</label>
                            <input name="videos[]" type="file" multiple class="form-control border border-2 p-2">
                            @error('videos')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <!-- Display an image if it exists -->
                            @if (!empty($event->images[0]))
                                <img src="{{ asset($event->images[0]) }}" style="max-width: 150px" alt="">
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn bg-gradient-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
