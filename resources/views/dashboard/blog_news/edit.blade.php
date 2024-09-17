<x-app-layout>
    <div class="container-fluid py-4">
        <div class="card card-body my-4">
            <h5 class="mb-4">Edit Blog/News Post</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dashboard.blog_news.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $post->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control" id="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-control" id="images" multiple>
                    @if ($post->images)
                        <div class="mt-2">
                            <p>Existing Images:</p>
                            @foreach (json_decode($post->images) as $image)
                                <img src="{{ asset($image) }}" style="width: 100px;" alt="Image">
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="videos" class="form-label">Videos</label>
                    <input type="file" name="videos[]" class="form-control" id="videos" multiple>
                    @if ($post->videos)
                        <div class="mt-2">
                            <p>Existing Videos:</p>
                            @foreach (json_decode($post->videos) as $video)
                                <video src="{{ asset($video) }}" controls style="width: 150px;"></video>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="author_id" class="form-label">Author</label>
                    <select name="author_id" class="form-control" id="author_id" required>
                        <option value="">Select Author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id', $post->author_id) == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
</x-app-layout>
