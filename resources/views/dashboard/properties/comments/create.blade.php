<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <form action="{{ route('dashboard.comments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" class="form-control">{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="user_id">User ID</label>
                        <input type="text" name="user_id" id="user_id" class="form-control" value="{{ old('user_id') }}">
                        @error('user_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lesson_id">Lecture ID</label>
                        <input type="text" name="lesson_id" id="lesson_id" class="form-control" value="{{ old('lesson_id') }}">
                        @error('lesson_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
            <button type="submit" class="btn bg-gradient-dark">Submit</button>
            </form>

        </div>
    </div>
    </div>

    </div>
</x-app-layout>
