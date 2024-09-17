<x-app-layout>
    <div class="container-fluid py-4">
        <div class="card card-body my-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Blog & News Posts</h5>
                <a href="{{ route('dashboard.blog_news.create') }}" class="btn btn-primary">Create New Post</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogNews as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->author->name }}</td> <!-- Assuming the author relation is loaded -->
                                <td>{{ $post->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('dashboard.blog_news.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('dashboard.blog_news.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No blog or news posts available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
