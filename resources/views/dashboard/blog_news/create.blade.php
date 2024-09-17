<x-app-layout>
    <div class="container-fluid py-4">
        <div class="card card-body my-4">
            <h5 class="mb-4">Create New Blog/News Post</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dashboard.blog_news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control" id="content" rows="5" required>{{ old('content') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-control" id="images" multiple>
                </div>

                <div class="mb-3">
                    <label for="videos" class="form-label">Videos</label>
                    <input type="file" name="videos[]" class="form-control" id="videos" multiple>
                </div>

                <div class="mb-3">
                    <label for="author_id" class="form-label">Author</label>
                    <select name="author_id" class="form-control" id="author_id" required>
                        <option value="">Select Author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </div>
</x-app-layout>
