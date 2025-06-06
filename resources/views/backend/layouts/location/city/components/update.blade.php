<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="updateLabel">Update City</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="updateCityForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="city_id" name="city_id" value="{{ $city->id }}">

                <!-- Country Selection -->
                <div class="mb-3">
                    <label for="edit_country_id" class="form-label">Country Name</label>
                    <select class="form-control" id="edit_country_id" name="country_id">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                @if($country->id == $city->country_id) selected @endif>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="v-error-message text-danger" id="edit_country_error"></p>
                </div>

                <!-- State Selection -->
                <div class="mb-3">
                    <label for="edit_state_id" class="form-label">State Name</label>
                    <select class="form-control" id="edit_state_id" name="state_id">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                @if($state->id == $city->state_id) selected @endif>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="v-error-message text-danger" id="edit_state_error"></p>
                </div>

                <!-- City Name Input -->
                <div class="mb-3">
                    <label for="edit_city_name" class="form-label">City Name</label>
                    <input type="text" class="form-control" id="edit_city_name" name="name" value="{{ $city->name }}">
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

                const cityName = $('#edit_city_name').val();
                const countryId = $('#edit_country_id').val();  // Get selected country ID
                const stateId = $('#edit_state_id').val()||null;  // Get selected state ID

                // Clear any previous error messages
                $('#edit_name_error').text('');
                $('#edit_country_error').text('');
                $('#edit_state_error').text('');

                // Validate form fields
                let hasError = false;

                if (!cityName) {
                    $('#edit_name_error').text('City name is required.');
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
                    name: cityName,
                    country_id: countryId,
                    state_id: stateId,
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}'
                };

                // Make the AJAX request to update the city
                $.ajax({
                    url: '{{ route('admin.city.update', $city->slug) }}',  // Update the city route
                    type: 'POST',
                    data: formData,
                    success: (response) => {

                        if (response.code== 200) {
                            dTable.draw();  // Redraw the data table
                            $('#updateModel').modal('hide');
                            $('#overlay').hide();  // Hide loading overlay
                            toastr.success('City updated successfully!');  // Show success message
                        } else {
                            $('#overlay').hide();
                            toastr.error('Something went wrong while updating the city.');
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
                            if (Xhr.responseJSON.errors['state_id']) {
                                $('#edit_state_error').text(Xhr.responseJSON.errors['state_id'][0]);
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
