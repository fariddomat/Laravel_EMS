<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <h4>Notifications</h4>
                <ul>
                    @foreach ($notifications as $notification)
                        <li class="{{ $notification->status === 'unread' ? 'font-weight-bold' : '' }}">
                            {{ $notification->message }}
                            @if ($notification->status === 'unread')
                                <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-link">Mark as Read</button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
