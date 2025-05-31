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
                                                <th scope="col">Author Name</th>
                                                <th scope="col">Date Join</th>
                                                <th scope="col">Total Properties </th>
                                                <th scope="col">Total Posted Jobs</th>
                                                <th scope="col">Payment </th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ $user->avatar }}" alt="Image"
                                                                class="avatar avatar-sm rounded-circle">
                                                            <div class="ms-2">
                                                                <h5 class="mb-0"><a href="#!"
                                                                        class="text-inherit">{{ $user->first_name . ' ' . $user->last_name }}</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>{{$user->properties->count()}}</td>

                                                    <td>{{$user->postedJobs->count()}}</td>
                                                    <td>
                                                        @if ($user->status)
                                                            <span
                                                                class="badge badge-success-soft rounded-pill">Active</span>
                                                    </td>
                                                @else
                                                    <span class="badge badge-danger-soft rounded-pill">Inactive</span></td>
                                            @endif
                                            <td>
                                                <a href="mailto:{{ $user->mail }}"
                                                    class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                    data-template="mailTwo">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-mail icon-xs">
                                                        <path
                                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                        </path>
                                                        <polyline points="22,6 12,13 2,6"></polyline>
                                                    </svg>
                                                    <div id="mailTwo" class="d-none">
                                                        <span>Mail</span>
                                                    </div>
                                                </a>
                                                {{-- <a href="#!"
                                                    class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                    data-template="lockTwo">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-lock icon-xs">
                                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                                            ry="2"></rect>
                                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                    </svg>
                                                    <div id="lockTwo" class="d-none">
                                                        <span>Block</span>
                                                    </div>
                                                </a> --}}
                                            </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer d-md-flex justify-content-between align-items-center  ">
                                {{-- Pagination links --}}
                                <div class="d-flex justify-content-center">
                                    {{ $users->links() }}
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
