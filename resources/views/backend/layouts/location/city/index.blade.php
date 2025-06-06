@extends('backend.app')

@section('title')
    Users-Admin
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

@section('main')
    <div id="overlay"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0, 0, 0, 0.5); z-index:9999;">
    </div>
    <div class="app-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- Page header -->
                    <div class="mb-5">
                        <h3 class="mb-0 ">City List</h3>

                    </div>
                </div>
            </div>
            <div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <!-- card -->
                        <div class="card mb-4">
                            <div class="card-header  ">
                                <div class="row justify-content-between">
                                    <div class="col-md-6 mb-3 ">
                                        <a href="#!" class="btn btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#addCitymodel">+ Add City</a>
                                    </div>

                                    <div class=" col-lg-4 col-md-6">
                                        <input type="search" id="search-input" class="form-control "
                                            placeholder="Search for name">
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
                                                <th>City Name</th>
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


    {{-- create modal start --}}
    <div class="modal fade" id="addCitymodel" tabindex="-1" aria-labelledby="addCitymodelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addCitymodelLabel">Add City</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createYachtType">
                        <div>
                            <div class="mb-3">
                                <label for="country_id" class="form-label">Country Name</label>
                                <select class="form-control" id="country_name">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="state_id" class="form-label">State Name</label>
                                <select class="form-control" id="state_name">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">City Name</label>
                                <input type="text" class="form-control" placeholder="Enter name" id="city_name">
                                <p class="v-error-message" id="name_error"></p>
                            </div>
                            <div class="text-end">
                                <button type="button" aria-hidden="true" class="btn btn-primary me-1"
                                    id="saveBtn">Save</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- create modal end --}}

    {{-- update modal start --}}
    <div class="modal fade" id="updateModel" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true"></div>
    {{-- update modal end --}}
@endsection
@push('scripts')
    {{-- Datatable --}}
    <script src="{{ asset('assets/dev/js/datatables.min.js') }}"></script>
    <script>
        let dTable;

        $(document).ready(function() {
            /**
             * Initializing the DataTable with custom configurations
             */
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
                            url: "{{ route('admin.city.index') }}",
                            type: "GET",
                            data: (d) => {
                                d.search = $('#search-input').val(); // Send custom search input value
                            }
                        },
                        columns: [
                            {
                                data: 'country_name',
                                name: 'country_name',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data:'state_name',
                                name:'state_name',
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
                            },
                        ]
                    });

                    // Custom search functionality for the DataTable
                    $('#search-input').on('keyup', function() {
                        dTable.draw(); // Redraw the table with the updated search input value
                    });
                }
            } catch (e) {
                toastr.error('Something went wrong while initializing DataTable');
                console.error(e);
            }

        /**
         * Handle Enter key press in city_name input field
         */
        $('#city_name').keypress(function(e) {
            if (e.which === 13) { // Check if Enter key is pressed
                e.preventDefault();
                $('#saveBtn').click(); // Trigger the save button click event
            }
        });

        /**
         * Create new city functionality
         */
        $('#saveBtn').click(() => {
            try {
                $('#overlay').show(); // Show loading overlay

                const cityName = $('#city_name').val();
                const countryId = $('#country_name').val(); // Get the selected country ID
                const stateId = $('#state_name').val()||null; // Get the selected state ID

                // Remove any previous validation error messages
                $('#name_error').text('');
                $('#country_error').text('');

                // Validation for empty fields
                let hasError = false;

                if (!cityName) {
                    $('#name_error').text('City name is required.');
                    hasError = true;
                }
                if (!countryId) {
                    $('#country_error').text('Country field is required.');
                    hasError = true;
                }
                // if (!stateId) {
                //     $('#state_error').text('State field is required.');
                //     hasError = true;
                // }

                // If there's a validation error, stop the AJAX request
                if (hasError) {
                    $('#overlay').hide();
                    return;
                }

                // Make the AJAX request to create the new city
                $.ajax({
                    url: `{{ route('admin.city.store') }}`,
                    type: `POST`,
                    data: {
                        'name': cityName,
                        'country_id': countryId,
                        'state_id': stateId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: (response) => {
                        if (response.code == 201) {
                            dTable.draw();
                            $('#city_name').val('');
                            $('#country_name').val('');
                            $('#state_name').val('');
                            $('#addCitymodel').modal('hide');
                            $('#overlay').hide(); // Hide loading overlay
                            toastr.success(
                                'City Created successfully!'); // Show success message

                        } else {
                            $('#overlay').hide();
                            toastr.error('Something went wrong while creating the city.');
                        }
                    },
                    error: (Xhr, status, error) => {
                        $('#overlay').hide(); // Hide loading overlay in case of error

                        if (Xhr && Xhr.responseJSON && Xhr.responseJSON.errors) {
                            // Display error messages from the server response
                            if (Xhr.responseJSON.errors['name']) {
                                $('#name_error').text(Xhr.responseJSON.errors['name'][0]);
                            }
                            if (Xhr.responseJSON.errors['country_id']) {
                                $('#country_error').text(Xhr.responseJSON.errors[
                                    'country_id'][0]);
                            }
                            if (Xhr.responseJSON.errors['state_id']) {
                                $('#state_error').text(Xhr.responseJSON.errors['state_id'][
                                    0
                                ]);
                            }
                        } else {
                            toastr.error(
                                'Something went wrong while processing the request.');
                        }
                    }
                });
            } catch (e) {
                $('#overlay').hide();
                toastr.error('An error occurred. Please try again.');
                console.error(e);
            }
        });

        /**
         * Reset modal form when modal is closed
         */
        $('#addCityModel').on('hidden.bs.modal', function() {
        $('#createYachtType')[0].reset(); // Reset the form fields when modal is hidden
        $('#name_error').text(''); // Clear any error messages
        $('#country_error').text('');
        $('#state_error').text('');
        });
        });



        /**
         *  show edit modal
         * */
        const editModal = (slug) => {
            try {
                $.ajax({
                    url: `{{ route('admin.city.edit', '') }}/${slug}`,
                    type: 'GET',
                    dataType: 'json',
                    success: (response) => {
                        console.log(response);
                        if (response.code == 200) {
                            $('#overlay').hide();
                            $('#updateModel').html(response.data.html);
                            $('#updateModel').modal('show');
                        } else {
                            $('#overlay').hide();
                            toastr.error('Something Went Wrong.!');
                        }
                    },
                    error: (xhr, status, error) => {
                        $('#overlay').hide();
                        toastr.error('Something Went Wrong.!');
                        console.error(error);
                    }
                });
            } catch (error) {
                $('#overlay').hide();
                toastr.error('Something went wrong');
                console.error(error);
            }
        }


        /**
         * Delete Alert
         * */
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
                        deleteContend(slug)
                    }
                });
            } catch (error) {
                toastr.error('Something went wrong');
                console.error(error);
            }
        }

        /**
         * delete function
         **/
        const deleteContend = (slug) => {
            try {
                $('#overlay').show();
                const formData = {
                    _method: 'DELETE'
                };
                $.ajax({
                    url: `{{ route('admin.city.destroy', '') }}/${slug}`,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: (response) => {
                        if (response.code == 202) {
                            dTable.draw();
                            $('#overlay').hide();
                            toastr.success('city Deleted successfully!');
                        } else {
                            $('#overlay').hide();
                            toastr.error('Something Went Wrong.!');
                        }
                    },
                    error: (xhr, status, error) => {
                        $('#overlay').hide();
                        toastr.error('Something Went Wrong.!');
                    }
                });
            } catch (e) {
                $('#overlay').hide();
                toastr.error('Something Went Wrong.!');
            }

        }
    </script>
@endpush
