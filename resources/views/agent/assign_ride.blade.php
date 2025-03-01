@extends('layouts.app')

@section('content')
    <style>
        .assign-table {
            width: 100%;
            border-collapse: collapse;
        }

        .assign-table th, .assign-table td {
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-key.js" crossorigin="anonymous"></script>

    <div class="container">
        <h2 class="text-center mb-4">Assign Driver to Booking</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('assign.ride') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="booking" class="form-label">Booking</label>
                <select name="booking_id" id="booking" class="form-control" required>
                    <option value="">Select Booking</option>
                    @foreach ($bookings as $booking)
                        <option value="{{ $booking->id }}" {{ old('booking_id') == $booking->id ? 'selected' : '' }}>
                            Booking #{{ $booking->id }} - {{ $booking->customer_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="driver" class="form-label">Driver</label>
                <select name="driver_id" id="driver" class="form-control" required>
                    <option value="">Select Driver</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Assign Driver
            </button>
        </form>

        <h3 class="text-center mt-4">Assigned Drivers</h3>
        <table class="table assign-table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Booking ID</th>
                    <th>Customer</th>
                    <th>Driver</th>
                    <th>Actions</th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach ($assignments as $index => $assignment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>#{{ $assignment->booking->id }}</td>
                        <td>{{ $assignment->booking->customer->name }}</td>
                        <td>{{ $assignment->driver->name }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form id="delete-form-{{ $assignment->id }}" action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $assignment->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody> --}}
        </table>
    </div>

    <script>
        function confirmDelete(assignmentId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This assignment will be permanently deleted.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + assignmentId).submit();
                }
            });
        }
    </script>
@endsection
