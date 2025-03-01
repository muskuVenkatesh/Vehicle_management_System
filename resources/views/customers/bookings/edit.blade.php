@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 40rem;">
        <h2 class="text-center mb-4">Update Booking #{{ $booking->id }}</h2>

        <form id="updateBookingForm">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label class="fw-bold">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" value="{{ $booking->customer_name }}" required>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Vehicle</label>
                <select name="vehicle_id" class="form-control" required>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" @if($booking->vehicle_id == $vehicle->id) selected @endif>
                            {{ $vehicle->model }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Pickup Location</label>
                <select name="pickup_location_id" class="form-control" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" @if($booking->pickup_location_id == $location->id) selected @endif>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Return Location</label>
                <select name="return_location_id" class="form-control" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" @if($booking->return_location_id == $location->id) selected @endif>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Pickup Date</label>
                <input type="date" name="pickup_date" class="form-control" value="{{ $booking->pickup_date }}" required>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Return Date</label>
                <input type="date" name="return_date" class="form-control" value="{{ $booking->return_date }}" required>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Total Amount</label>
                <input type="number" name="total_amount" class="form-control" value="{{ $booking->total_amount }}" required>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Booking Status</label>
                <select name="booking_status" class="form-control" required>
                    <option value="pending" @if($booking->booking_status == 'pending') selected @endif>Pending</option>
                    <option value="confirmed" @if($booking->booking_status == 'confirmed') selected @endif>Confirmed</option>
                    <option value="canceled" @if($booking->booking_status == 'canceled') selected @endif>Canceled</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Payment Status</label>
                <select name="payment_status" class="form-control" required>
                    <option value="pending" @if($booking->payment_status == 'pending') selected @endif>Pending</option>
                    <option value="paid" @if($booking->payment_status == 'paid') selected @endif>Paid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Update Booking</button>
        </form>
    </div>
</div>

<!-- Include jQuery and SweetAlert -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $("#updateBookingForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            let bookingId = "{{ $booking->id }}";

            $.ajax({
                url: "{{ route('bookings.update', $booking->id) }}",
                type: "PUT",
                data: formData,
                success: function (response) {
                    Swal.fire({
                        title: "Updated!",
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
