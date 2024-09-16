<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <form action="{{ route('dashboard.image.store', $property) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Image</label>
                            <input name="img" type="file" class="form-control border border-2 p-2"
                                value="{{ old('img') }}">
                            @error('img')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>



            </div>
            <button type="submit" class="btn bg-gradient-dark">Submit</button>
            </form>

        </div>
    </div>
    </div>

    </div>
</x-app-layout>
