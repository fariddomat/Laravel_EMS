<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <form action="{{ route('dashboard.comments_ratings.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Event</label>
                            <select name="event_id" class="form-control border border-2 p-2">
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            </select>
                            @error('event_id')
                                <p class='text-danger inputerror'>{{ $message }}</p>
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
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Comment</label>
                            <textarea name="comment" class="form-control border border-2 p-2" cols="30" rows="5">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Rating</label>
                            <input name="rating" type="number" class="form-control border border-2 p-2" value="{{ old('rating') }}" min="1" max="5">
                            @error('rating')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn bg-gradient-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
