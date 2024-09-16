<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <form action="{{ route('dashboard.properties.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control border border-2 p-2" value="{{ old('name') }}">
                            @error('name')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="1" class="form-control border border-2 p-2" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Price</label>
                            <input name="price" type="number" class="form-control border border-2 p-2" value="{{ old('price') }}">
                            @error('price')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Area (sqm)</label>
                            <input name="area" type="number" class="form-control border border-2 p-2" value="{{ old('area') }}">
                            @error('area')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Rooms</label>
                            <input name="rooms" type="number" class="form-control border border-2 p-2" value="{{ old('rooms') }}">
                            @error('rooms')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Direction</label>
                            <input name="direction" type="text" class="form-control border border-2 p-2" value="{{ old('direction') }}">
                            @error('direction')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Address</label>
                            <input name="address" type="text" class="form-control border border-2 p-2" value="{{ old('address') }}">
                            @error('address')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control border border-2 p-2">
                                @if (auth()->user()->hasRole('owner'))
                                <option value="pending">بانتاظر الموافقة</option>
                                <option value="closed">مغلق</option>
                                @else
                                <option value="available">متاح</option>
                                <option value="pending">بانتاظر الموافقة</option>
                                <option value="closed">مغلق</option>
                                @endif
                             </select>
                            @error('status')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="type">Type</label>
                            <select name="type" class="form-control border border-2 p-2">
                               <option value="آجار">آجار</option>
                               <option value="بيع">بيع</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="user_id">User</label>
                            <select name="user_id" class="form-control border border-2 p-2">
                                @if (auth()->user()->hasRole('owner'))
                                <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                                @else
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"{{ old('user_id') == $user->id ? ' selected' : '' }}>{{ $user->name }}</option>
                                @endforeach

                                @endif
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-control border border-2 p-2">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"{{ old('category_id') == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

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
                    <button type="submit" class="btn bg-gradient-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
