@section('styles')
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/r-3.0.1/rr-1.5.0/datatables.min.css" rel="stylesheet">
    <style>
        div.dt-container div.dt-search input {
            border: 1px solid #dee2e6 !important;
        }
    </style>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/r-3.0.1/rr-1.5.0/datatables.min.js" defer></script>
    <script>
        $(document).ready(function() {
            var servicesTable = $("#Table").DataTable({
                searching: true,
                paging: true,
                info: false,

            });



        });
    </script>
    <script></script>
@endsection

<x-app-layout>
    <div class="">
        <!-- Navbar -->
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="row bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="col-6 text-white text-capitalize ps-3">properties table</h6>
                                <div class="col-6 text-end">
                                    <a class="btn bg-gradient-dark mb-0"
                                        href="{{ route('dashboard.properties.create') }}"><i
                                            class="material-icons text-sm">add</i>
                                        &nbsp;&nbsp;Add
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="Table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>

                                                <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                name

                                            </th>

                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($properties as $index => $property)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">

                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                                        </div>
                                                    </div>
                                                </td>


                                                <td>
                                                    <div class="d-flex px-2 py-1">

                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-capitalize">{{ $property->name }}
                                                                @if ($property->status == 'pending')
                                                                <span style="color: gold">(بانتظار الموافقة)</span>
                                                            @endif
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="align-middle">

                                                    <a rel="tooltip" class="btn btn-primary btn-link"
                                                    href="{{ route('dashboard.image.index', $property) }}"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">camera</i>
                                                    <div class="ripple-container"></div>
                                                </a>


                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ route('dashboard.properties.edit', $property) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>

                                                    <form
                                                        action="{{ route('dashboard.properties.destroy', $property) }}"
                                                        method="POST" style="  display: unset;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-link">
                                                            <i class="material-icons">close</i>
                                                            <div class="ripple-container"></div>
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
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
