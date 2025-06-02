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
                        <h3 class="mb-0 ">Country List</h3>

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
                                            data-bs-target="#addCountryModel">+ Add Country</a>
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
                                                <th>Name</th>
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
    <div class="modal fade" id="addCountryModel" tabindex="-1" aria-labelledby="addCountryModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addCountryModelLabel">Add Country</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createYachtType">
                        <div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Country Name</label>
                                <input type="text" class="form-control" placeholder="Enter name" id="country_name">
                                <p class="v-error-message" id="name_error"></p>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary me-1" id="saveBtn">Save</button>
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
             *Indexing the table
             * */
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
                            url: "{{ route('admin.country.index') }}",
                            type: "GET",
                            data: (d) => {
                                d.search = $('#search-input').val();
                            }
                        },
                        columns: [{
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
                    // Custom search functionality
                    $('#search-input').on('keyup', function() {
                        dTable.draw(); // Redraw the table with the custom search value
                    });
                }
            } catch (e) {
                toastr.error('something went wrong');
                console.error(e);
            }

            $('#country_name').keypress(function(e) {
                if (e.which === 13) { // Check if Enter key is pressed
                    e.preventDefault();
                    $('#saveBtn').click();
                }
            });
            /**
             * Create new country
             * */
            $(`#saveBtn`).click(() => {
                try {
                    $('#overlay').show();
                    const countryName = $('#country_name').val();

                    // removing validation messages
                    $('#name_error').text('');

                    $.ajax({
                        url: `{{ route('admin.country.store') }}`,
                        type: `POST`,
                        data: {
                            'name': countryName,
                        },
                        success: (response) => {
                            if (response.code == 201) {
                                dTable.draw();
                                $('#country_name').val('');
                                $('#addCountryModel').modal('hide');
                                $('#overlay').hide();
                                toastr.success('Country Created successfully!');
                            } else {
                                $('#overlay').hide();
                                toastr.error('Something Went Wrong.!');
                            }
                        },
                        error: (Xhr, status, error) => {
                            $('#overlay').hide();
                            if (Xhr && Xhr.responseJSON && Xhr.responseJSON.errors && Xhr
                                .responseJSON.errors['name'] && Xhr.responseJSON.errors['name'][
                                    0
                                ]) {
                                $('#name_error').text(Xhr.responseJSON.errors['name'][0]);
                            } else {
                                toastr.error('Something Went Wrong.!');
                            }
                        }
                    })
                } catch (e) {
                    $('#overlay').hide();
                    toastr.error('Something Went Wrong.!');
                    console.error(e);
                }
            });
        });


        /**
         *  show edit modal
         * */
        const editModal = (slug) => {
            try {
                // $('#overlay').show();
                $.ajax({
                    url: `{{ route('admin.country.edit', '') }}/${slug}`,
                    type: 'GET',
                    dataType: 'json',
                    success: (response) => {
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
                    url: `{{ route('admin.country.destroy', '') }}/${slug}`,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: (response) => {
                        if (response.code == 202) {
                            dTable.draw();
                            $('#overlay').hide();
                            toastr.success('Country Deleted successfully!');
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
