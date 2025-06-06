@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || State
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/dev/css/datatables.min.css') }}">
    <style>
        .dt-info {
            display: flex;
            justify-content: center;
        }

        .paging_full_numbers {
            display: flex;
            justify-content: center;
            padding-bottom: 10px;
        }
    </style>
@endpush

@section('content')
    <div id="overlay"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0, 0, 0, 0.5); z-index:9999;">
    </div>
    <div id="app-content">
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div class="mb-5">
                            <h3 class="mb-0 ">State List</h3>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <!-- card -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="row justify-content-between">
                                        <div class="col-md-6 mb-3">
                                            <a href="#!" class="btn btn-primary me-2" data-bs-toggle="modal"
                                                data-bs-target="#addCustomerModal">+ Add State</a>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <input type="search" id="search-input" class="form-control"
                                                placeholder="Search for state name">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table text-nowrap mb-0 table-centered table-hover" id="data-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Country Name</th>
                                                    <th>State Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addCustomerModalLabel">Add State</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createStateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="country_id" class="form-label">Country Name</label>
                            <select class="form-control" id="country_id" name="country_id">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <p class="v-error-message text-danger" id="country_error"></p>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">State Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" id="state_name"
                                name="name">
                            <p class="v-error-message text-danger" id="name_error"></p>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-primary me-1" id="saveBtn">Save</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Update Modal --}}
    <div class="modal fade" id="updateModel" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true"></div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dev/js/datatables.min.js') }}"></script>
    <script>
        let dTable;
        $(document).ready(function() {
            try {
                if (!$.fn.DataTable.isDataTable('#data-table')) {
                    dTable = $('#data-table').DataTable({
                        ordering: false,
                        lengthMenu: [
                            [10, 25, 50, 100, 200, 500, -1],
                            [10, 25, 50, 100, 200, 500, "All"]
                        ],
                        processing: true,
                        responsive: true,
                        serverSide: true,
                        searching: false,
                        language: {
                            processing: ''
                        },
                        scroller: {
                            loadingIndicator: true
                        },
                        pagingType: "full_numbers",
                        dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'f>>tipr",
                        ajax: {
                            url: "{{ route('state.index') }}",
                            type: "GET",
                            data: (d) => {
                                d.search = $('#search-input').val();
                            }
                        },
                        columns: [{
                                data: 'country_name',
                                name: 'country_name',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'name',
                                name: 'name',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }
                        ]
                    });

                    // Custom search functionality
                    $('#search-input').on('keyup', function() {
                        dTable.draw(); // Redraw the table with the custom search value
                    });
                }
            } catch (error) {
                console.error("DataTables Error: ", error);
            }
            $('#state_name').keypress(function(e) {
                if (e.which === 13) { // Check if Enter key is pressed
                    e.preventDefault();
                    $('#saveBtn').click();
                }
            });
            $('#country_id').keypress(function(e) {
                if (e.which === 13) { // Check if Enter key is pressed
                    e.preventDefault();
                    $('#saveBtn').click();
                }
            });


            // Save State
            $('#saveBtn').click(() => {
                try {
                    $('#overlay').show();
                    const stateName = $('#state_name').val();
                    const countryId = $('#country_id').val();

                    // Clear validation messages
                    $('#name_error').text('');
                    $('#country_error').text('');

                    // Validate form fields
                    let hasError = false;

                    if (!stateName) {
                        $('#name_error').text('State name is required.');
                        hasError = true;
                    }
                    if (!countryId) {
                        $('#country_error').text('Country field is required.');
                        hasError = true;
                    }

                    if (hasError) {
                        $('#overlay').hide();
                        return;
                    }

                    // AJAX request to save state
                    $.ajax({
                        url: `{{ route('state.store') }}`,
                        type: `POST`,
                        data: {
                            name: stateName,
                            country_id: countryId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: (response) => {
                            if (response.code == 201) {
                                dTable.draw();
                                $('#state_name').val('');
                                $('#country_id').val('');
                                $('#addCustomerModal').modal('hide');
                                $('#overlay').hide();
                                toastr.success('State created successfully!');
                            } else {
                                $('#overlay').hide();
                                toastr.error('Something went wrong!');
                            }
                        },
                        error: (Xhr, status, error) => {
                            $('#overlay').hide();
                            if (Xhr && Xhr.responseJSON && Xhr.responseJSON.errors) {
                                if (Xhr.responseJSON.errors['name']) {
                                    $('#name_error').text(Xhr.responseJSON.errors['name'][0]);
                                }
                                if (Xhr.responseJSON.errors['country_id']) {
                                    $('#country_error').text(Xhr.responseJSON.errors[
                                        'country_id'][0]);
                                }
                            } else {
                                toastr.error('Something went wrong!');
                            }
                        }
                    });
                } catch (e) {
                    $('#overlay').hide();
                    toastr.error('Something went wrong!');
                    console.error(e);
                }
            });
        });

        // Edit State Modal
        const editModal = (slug) => {
            try {
                // $('#overlay').show();
                $.ajax({
                    url: `{{ route('state.edit', ':slug') }}`.replace(':slug', slug),
                    type: 'GET',
                    dataType: 'json',
                    success: (response) => {
                        if (response.code == 200) {
                            $('#overlay').hide();
                            $('#updateModel').html(response.data.html);
                            $('#updateModel').modal('show');
                        } else {
                            $('#overlay').hide();
                            toastr.error('Something went wrong!');
                        }
                    },
                    error: (xhr, status, error) => {
                        $('#overlay').hide();
                        toastr.error('Something went wrong!');
                        console.error("AJAX Error: ", error);
                    }
                });
            } catch (error) {
                $('#overlay').hide();
                toastr.error('Something went wrong!');
                console.error("JavaScript Error: ", error);
            }
        };

        // Delete State
        const deleteAlert = (slug) => {
            try {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#624bff",
                    cancelButtonColor: "#929292",
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteContend(slug);
                    }
                });
            } catch (error) {
                toastr.error('Something went wrong!');
                console.error(error);
            }
        };

        const deleteContend = (slug) => {
            try {
                $('#overlay').show();
                const formData = {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                };
                $.ajax({
                    url: `{{ route('state.destroy', ':slug') }}`.replace(':slug', slug),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: (response) => {
                        if (response.code == 202) {
                            dTable.draw();
                            $('#overlay').hide();
                            toastr.success('State deleted successfully!');
                        } else {
                            $('#overlay').hide();
                            toastr.error('Something went wrong!');
                        }
                    },
                    error: (xhr, status, error) => {
                        $('#overlay').hide();
                        toastr.error('Something went wrong!');
                    }
                });
            } catch (e) {
                $('#overlay').hide();
                toastr.error('Something went wrong!');
                console.error(e);
            }
        };
    </script>
@endpush
