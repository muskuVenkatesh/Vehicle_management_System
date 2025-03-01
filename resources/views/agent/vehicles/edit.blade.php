@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 40rem; max-height: 90vh; overflow-y: auto;">
        <h2 class="text-center text-primary">Update Vehicle</h2>
        <div class="modal-body">
            <form id="updateVehicleForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label class="fw-bold">Make</label>
                    <input type="text" name="make" class="form-control" value="{{ $vehicle->make }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Model <span class="text-danger">*</span></label>
                    <input type="text" name="model" class="form-control" value="{{ $vehicle->model }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Year <span class="text-danger">*</span></label>
                    <input type="number" name="year" class="form-control" value="{{ $vehicle->year }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Vehicle Type <span class="text-danger">*</span></label>
                    <input type="text" name="vehicle_type" class="form-control" value="{{ $vehicle->vehicle_type }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Color <span class="text-danger">*</span></label>
                    <input type="text" name="color" class="form-control" value="{{ $vehicle->color }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">License Plate (Unique)</label>
                    <input type="text" name="license_plate" class="form-control" value="{{ $vehicle->license_plate }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Mileage <span class="text-danger">*</span></label>
                    <input type="number" name="mileage" class="form-control" value="{{ $vehicle->mileage }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Fuel Type <span class="text-danger">*</span></label>
                    <input type="text" name="fuel_type" class="form-control" value="{{ $vehicle->fuel_type }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Engine Capacity <span class="text-danger">*</span></label>
                    <input type="number" name="engine_capacity" class="form-control" value="{{ $vehicle->engine_capacity }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Seating Capacity <span class="text-danger">*</span></label>
                    <input type="number" name="seating_capacity" class="form-control" value="{{ $vehicle->seating_capacity }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Availability <span class="text-danger">*</span></label>
                    <select name="availability" class="form-control">
                        <option value="1" {{ $vehicle->availability ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ !$vehicle->availability ? 'selected' : '' }}>Not Available</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Daily Rate <span class="text-danger">*</span></label>
                    <input type="number" name="daily_rate" step="0.01" class="form-control" value="{{ $vehicle->daily_rate }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Hourly Rate <span class="text-danger">*</span></label>
                    <input type="number" name="hourly_rate" step="0.01" class="form-control" value="{{ $vehicle->hourly_rate }}">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Vehicle Image</label>
                    <input type="file" name="image_url" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Description</label>
                    <textarea name="description" class="form-control">{{ $vehicle->description }}</textarea>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Location <span class="text-danger">*</span></label>
                    <select name="location_id" class="form-control">
                        <option value="">Select Location</option>
                        @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $vehicle->location_id == $location->id ? 'selected' : '' }}>
                            {{ $location->location_name }}
                        </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Update Vehicle</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $("#updateVehicleForm").submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            let vehicleId = "{{ $vehicle->id }}"; // Get vehicle ID from Blade template

            $.ajax({
                url: "{{ url('vehicles') }}/" + vehicleId, // Use correct update URL
                type: "POST", // Laravel requires POST for FormData, but we'll spoof PUT
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "{{ route('vehicles.index') }}";
                    });
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;

                    // Clear previous errors
                    $(".is-invalid").removeClass("is-invalid");
                    $(".invalid-feedback").text("");

                    // Display new errors
                    $.each(errors, function (key, value) {
                        let input = $(`[name="${key}"]`);
                        input.addClass("is-invalid");
                        input.siblings(".invalid-feedback").text(value[0]); // Show first error message
                    });

                    Swal.fire({
                        title: "Error!",
                        text: "Please correct the errors in the form.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });
    });
</script>


@endsection
