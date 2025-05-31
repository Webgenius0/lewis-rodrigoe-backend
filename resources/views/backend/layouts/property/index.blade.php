@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Client
@endsection

@section('content')
    <div id="app-content">
        <div class="app-content-area">
            <!-- Container fluid -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h3 class="mb-0 ">Clients</h3>
                            {{-- <a href="#!" class="btn btn-primary">Button</a> --}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="card h-100">
                            {{-- <div class="card-header d-md-flex justify-content-between align-items-center">

                                <form>
                                    <div class="mb-3 mb-md-0">
                                        <input type="search" class="form-control" placeholder="Search Author">
                                    </div>
                                </form>
                                <a href="#!" class="btn btn-primary">Add New Author</a>


                            </div> --}}
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table mb-0 text-nowrap table-centered">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">Property ID</th>
                                                <th scope="col">Added At</th>
                                                <th scope="col">Address </th>
                                                <th scope="col">Total Posted Jobs</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($properties as $property)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="ms-2">
                                                                <h5 class="mb-0"><a href="#!"
                                                                        class="text-inherit">{{ $property->sn }}</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>{{ $property->created_at }}</td>
                                                    <td>{{ $property->address->label }}</td>

                                                    <td>{{ $property->jobs->count() }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer d-md-flex justify-content-between align-items-center  ">
                                {{-- Pagination links --}}
                                <div class="d-flex justify-content-center">
                                    {{ $properties->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
    <script>
        $(document).ready(function() {
            // Echo.private('chat.' + 2).listen('MessageSent', (e) => {
            //     console.log(e);
            // })
            Echo.private('chat.' + 1).listen('MessageSent', (e) => {
                console.log(e);
            })
        });
    </script>
@endpush
