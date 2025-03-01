@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 40rem;">
        <h2 class="text-center text-primary">Book a Vehicle</h2>

        <div class="modal-body">
            <form id="bookVehicleForm">
                @csrf

                <div class="form-group mb-3">
                    <label class="fw-bold">Name</label>
                    <input type="text" name="customer_name" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Vehicle</label>
                    <select name="vehicle_id" class="form-control">
                        <option value="">Select Vehicle</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->model }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Pickup Location</label>
                    <select name="pickup_location_id" class="form-control">
                        <option value="">Select Pickup Location</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Return Location</label>
                    <select name="return_location_id" class="form-control">
                        <option value="">Select Return Location</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Pickup Date</label>
                    <input type="date" name="pickup_date" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Return Date</label>
                    <input type="date" name="return_date" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Total Amount</label>
                    <input type="number" name="total_amount" class="form-control" step="0.01">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Booking Status</label>
                    <select name="booking_status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Payment Status</label>
                    <select name="payment_status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-3">Book Vehicle</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $("#bookVehicleForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('bookings.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "{{ route('bookings.index') }}";
                    });
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = "";

                    $.each(errors, function (key, value) {
                        errorMsg += value + "\n";
                    });

                    Swal.fire({
                        title: "Error!",
                        text: errorMsg,
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });
    });
</script>
@endsection
