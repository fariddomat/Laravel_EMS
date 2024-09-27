<x-app-layout>
    <div class="container">
        <h3>Event Suggestions</h3>

        @if (count($suggestions) > 0)
            @foreach ($suggestions as $suggestion)
                <div class="card my-3">
                    <div class="card-body">
                        <h4>{{ $suggestion }}</h4>
                    </div>
                </div>
            @endforeach
        @else
            <p>No suggestions available.</p>
        @endif
    </div>
</x-app-layout>
