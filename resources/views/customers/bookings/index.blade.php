@extends('layouts.app')

@section('content')
    <style>
        .booking-table {
            width: 100%;
            border-collapse: collapse;
        }

        .booking-table th, .booking-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container">
        <h2 class="text-center mb-4">Manage Bookings</h2>
        <a href="{{ route('bookings.create') }}" class="btn btn-success mb-3">Book Vehicle</a>

        <table class="table booking-table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Vehicle</th>
                    <th>Pickup Location</th>
                    <th>Return Location</th>
                    <th>Pickup Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $index => $booking)

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        {{-- <td>{{ $booking->customer->customer_name }}</td> --}}
                        <td>{{ $booking->vehicle->name }}</td>
                        <td>{{ $booking->pickupLocation->name }}</td>
                        <td>{{ $booking->returnLocation->name }}</td>
                        <td>{{ $booking->pickup_date }}</td>
                        <td>{{ $booking->return_date }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->booking_status == 'confirmed' ? 'success' : 'warning' }}">
                                {{ ucfirst($booking->booking_status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $booking->payment_status == 'paid' ? 'success' : 'danger' }}">
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info btn-sm"
                                    onclick="showBookingDetails({{ $booking->id }}, '{{ $booking->customer_name }}', '{{ $booking->vehicle->name }}', '{{ $booking->pickup_date }}', '{{ $booking->return_date }}', '{{ $booking->total_amount }}')">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form id="delete-form-{{ $booking->id }}" action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $booking->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-3">{{ $bookings->links() }}</div>
    </div>

    {{-- Booking Details Modal --}}
    <div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-labelledby="bookingDetailsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingDetailsLabel">Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Customer:</strong> <span id="bookingCustomer"></span></p>
                    <p><strong>Vehicle:</strong> <span id="bookingVehicle"></span></p>
                    <p><strong>Pickup Date:</strong> <span id="bookingPickupDate"></span></p>
                    <p><strong>Return Date:</strong> <span id="bookingReturnDate"></span></p>
                    <p><strong>Total Amount:</strong> $<span id="bookingTotal"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showBookingDetails(id, customer, vehicle, pickupDate, returnDate, totalAmount) {
            $('#bookingCustomer').text(customer);
            $('#bookingVehicle').text(vehicle);
            $('#bookingPickupDate').text(pickupDate);
            $('#bookingReturnDate').text(returnDate);
            $('#bookingTotal').text(totalAmount);

            $('#bookingDetailsModal').modal('show');
        }

        function confirmDelete(bookingId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This booking will be permanently deleted.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + bookingId).submit();
                }
            });
        }
    </script>
@endsection
