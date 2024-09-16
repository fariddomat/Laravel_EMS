<x-app-layout>


    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div> --}}


            <div class="py-4 my-6">
                <div class="card card-body my-4  mt-n6">
                    <div class="row gx-4 mb-2">
                        <form action="{{ route('profile.updateInfo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-lg bg-primary p-2 rounded text-white"
                            >{{ __('Saved.') }}</p>
                        @endif
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control border border-2 p-2" value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control border border-2 p-2" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>



                                <div class="mb-3 col-md-6">

                                    <label class="form-label">Image</label>
                                    <input name="image" type="file" class="form-control border border-2 p-2">
                                    @error('image')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>


                            </div>

                            <button type="submit" class="btn bg-gradient-dark">Save</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>
