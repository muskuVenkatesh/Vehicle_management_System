@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 40rem; max-height: 90vh; overflow-y: auto;">
        <h2 class="text-center text-primary">Create New Vehicle</h2>
        <div class="modal-body">
            <form id="createVehicleForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label class="fw-bold">Make</label>
                    <input type="text" name="make" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Model <span class="text-danger">*</span></label>
                    <input type="text" name="model" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Year <span class="text-danger">*</span></label>
                    <input type="number" name="year" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Vehicle Type <span class="text-danger">*</span></label>
                    <input type="text" name="vehicle_type" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Color <span class="text-danger">*</span></label>
                    <input type="text" name="color" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">License Plate (Unique)</label>
                    <input type="text" name="license_plate" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Mileage <span class="text-danger">*</span></label>
                    <input type="number" name="mileage" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Fuel Type <span class="text-danger">*</span></label>
                    <input type="text" name="fuel_type" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Engine Capacity <span class="text-danger">*</span></label>
                    <input type="number" name="engine_capacity" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Seating Capacity <span class="text-danger">*</span></label>
                    <input type="number" name="seating_capacity" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Availability <span class="text-danger">*</span></label>
                    <select name="availability" class="form-control">
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Daily Rate <span class="text-danger">*</span></label>
                    <input type="number" name="daily_rate" step="0.01" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Hourly Rate <span class="text-danger">*</span></label>
                    <input type="number" name="hourly_rate" step="0.01" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Vehicle Image</label>
                    <input type="file" name="image_url" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Location <span class="text-danger">*</span></label>
                    <select name="location_id" class="form-control">
                        <option value="">Select Location</option>
                        @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-3">Create Vehicle</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $("#createVehicleForm").submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('vehicles.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
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
                    $(".is-invalid").removeClass("is-invalid");
                    $(".invalid-feedback").text("");

                    $.each(errors, function (key, value) {
                        let input = $(`[name="${key}"]`);
                        input.addClass("is-invalid");
                        input.siblings(".invalid-feedback").text(value[0]);
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
