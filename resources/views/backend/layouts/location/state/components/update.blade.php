<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="updateLabel">Edit State</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="updateStateForm">
                @csrf
                @method('PUT')

                <!-- Country Selection -->
                <div class="mb-3">
                    <label for="edit_country_id" class="form-label">Country Name</label>
                    <select class="form-control" id="edit_country_id" name="country_id">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                @if($country->id == $state->country_id) selected @endif>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="v-error-message text-danger" id="edit_country_error"></p>
                </div>

                <!-- State Name -->
                <div class="mb-3">
                    <label for="edit_state_name" class="form-label">State Name</label>
                    <input type="text" class="form-control" id="edit_state_name" name="name" value="{{ $state->name }}">
                    <p class="v-error-message text-danger" id="edit_name_error"></p>
                </div>

                <div class="text-end">
                    <button type="button" class="btn btn-primary me-1" id="updateBtn">Update</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        $('#updateBtn').click((e) => {
            try {
                $('#overlay').show();  // Show loading overlay
                e.preventDefault();  // Prevent default form submission

                const stateName = $('#edit_state_name').val();
                const countryId = $('#edit_country_id').val();  // Get selected country ID

                // Clear any previous error messages
                $('#edit_name_error').text('');
                $('#edit_country_error').text('');

                // Validate form fields
                let hasError = false;

                if (!stateName) {
                    $('#edit_name_error').text('State name is required.');
                    hasError = true;
                }
                if (!countryId) {
                    $('#edit_country_error').text('Country field is required.');
                    hasError = true;
                }

                // If there's a validation error, stop the AJAX request
                if (hasError) {
                    $('#overlay').hide();  // Hide loading overlay
                    return;
                }

                // Create the form data for AJAX request
                const formData = {
                    name: stateName,
                    country_id: countryId,
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}'
                };

                // Make the AJAX request to update the state
                $.ajax({
                    url: '{{ route('admin.state.update', $state->slug) }}',  // Update the state route
                    type: 'POST',
                    data: formData,
                    success: (response) => {
                        if (response.code == 200) {
                        console.log('hello masud');

                            dTable.draw();
                            $('#updateModel').modal('hide');
                            $('#overlay').hide();
                            toastr.success('State updated successfully!');  // Show success message
                        } else {
                            console.log('hello masud erroe');
                            $('#overlay').hide();
                            toastr.error('Something went wrong while updating the state.');
                        }
                    },
                    error: (Xhr, status, error) => {
                        $('#overlay').hide();  // Hide loading overlay in case of error

                        if (Xhr && Xhr.responseJSON && Xhr.responseJSON.errors) {
                            // Display validation errors from server response
                            if (Xhr.responseJSON.errors['name']) {
                                $('#edit_name_error').text(Xhr.responseJSON.errors['name'][0]);
                            }
                            if (Xhr.responseJSON.errors['country_id']) {
                                $('#edit_country_error').text(Xhr.responseJSON.errors['country_id'][0]);
                            }
                        } else {
                            toastr.error('Something went wrong while processing the request.');
                        }
                    }
                });
            } catch (error) {
                $('#overlay').hide();
                toastr.error('An error occurred. Please try again.');
                console.error(error);
            }
        });
    });
</script>
