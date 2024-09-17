<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <form action="{{ route('dashboard.companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control border border-2 p-2"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">User</label>
                            <select name="user_id" class="form-control border border-2 p-2">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control border border-2 p-2" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-control border border-2 p-2">
                                <option value="person" {{ old('type') == 'person' ? 'selected' : '' }}>Person</option>
                                <option value="website" {{ old('type') == 'website' ? 'selected' : '' }}>Website</option>
                            </select>
                            @error('type')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Roles</label>
                            <input name="roles" type="text" class="form-control border border-2 p-2"
                                value="{{ old('roles') }}" placeholder="Photographer, Hair Stylist, etc.">
                            @error('roles')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Images</label>
                            <input name="images[]" type="file" multiple class="form-control border border-2 p-2">
                            @error('images')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Videos</label>
                            <input name="videos[]" type="file" multiple class="form-control border border-2 p-2">
                            @error('videos')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn bg-gradient-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
