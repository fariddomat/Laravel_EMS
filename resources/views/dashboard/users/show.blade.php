<x-app-layout>
    <div class="container-fluid py-4 my-6">
        <div class="card card-body my-4 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input disabled name="name" type="text" class="form-control border border-2 p-2" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email</label>
                            <input disabled name="email" type="email" class="form-control border border-2 p-2" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-control border border-2 p-2" disabled>
                                <option value="">Select Role</option>
                                @foreach(Spatie\Permission\Models\Role::all() as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>


                        <div class="mb-3 col-md-12">
                            <img class="avatar" src="{{ asset($user->profile_picture) }}" alt="" style="height: 150px;
                            width: 150px;">

                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
