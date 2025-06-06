<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="updateLabel">Edit Country</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('location.country.update', $country->slug) }}" method="POST" id="updateCountry">
                @csrf
                @method('PUT')
                <div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Country Name</label>
                        <input type="text" value="{{ $country->name }}" class="form-control"
                            placeholder="Enter name" id="update_country_name">
                        <p class="v-error-message" id="update_name_error"></p>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary me-1" id="updateBtn">Save</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => {
        $('#updateBtn').click((e) => {
            try {
                $('#overlay').show();
                e.preventDefault();

                const countryName = $('#update_country_name').val();

                // Clear any previous error messages
                $('#update_name_error').text('');

                const formData = {
                    name: countryName,
                    _method: 'PUT'
                };

                $.ajax({
                    url: '{{ route('location.country.update', $country->slug) }}',
                    type: 'POST',
                    data: formData,
                    success: (response) => {
                        if (response.code == 202) {
                            dTable.draw();
                            $('#updateModel').modal('hide');
                            $('#overlay').hide();
                            toastr.success('Country Updated successfully!');
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
                            $('#update_name_error').text(Xhr.responseJSON.errors['name'][
                                0
                            ]);
                        } else {
                            toastr.error('Something Went Wrong.!');
                        }
                    }
                });
            } catch (error) {
                $('#updateModel').modal('hide');
                console.error(error);
                toastr.error('Something Went Wrong.!');
            }
        });
    });
</script>
