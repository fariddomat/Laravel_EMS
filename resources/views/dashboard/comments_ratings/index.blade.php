<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-md-12">
                    <a href="{{ route('dashboard.comments_ratings.create') }}" class="btn bg-gradient-dark mb-3">
                        <i class="material-icons text-sm">add</i> Add New
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Event</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comment</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rating</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commentsRatings as $commentRating)
                            <tr>
                                <td>{{ $commentRating->id }}</td>
                                <td>{{ $commentRating->event->name }}</td>
                                <td>{{ $commentRating->user->name }}</td>
                                <td>{{ $commentRating->comment }}</td>
                                <td>{{ $commentRating->rating }}</td>
                                <td class="align-middle">
                                    {{-- <a href="{{ route('dashboard.comments_ratings.edit', $commentRating->id) }}" class="btn btn-success btn-link">
                                        <i class="material-icons">edit</i>
                                    </a> --}}
                                    <form action="{{ route('dashboard.comments_ratings.destroy', $commentRating->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-link">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
