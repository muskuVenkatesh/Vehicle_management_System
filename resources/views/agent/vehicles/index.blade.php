@extends('layouts.app')

@section('content')
    <style>
        .vehicle-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .vehicle-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .vehicle-card:hover {
            transform: scale(1.05);
        }

        .vehicle-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .vehicle-info {
            padding: 15px;
            text-align: center;
        }

        .vehicle-info h5 {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .btn-group {
            display: flex;
            justify-content: space-around;
            padding: 10px;
        }
    </style>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container">
        <h2 class="text-center mb-4">Manage Vehicles</h2>
        <a href="{{ route('vehicles.create') }}" class="btn btn-success mb-3">Add New Vehicle</a>

        <div class="vehicle-grid">
            @foreach ($vehicles as $vehicle)
                <div class="vehicle-card">
                    <img src="{{ $vehicle->image_url ?? 'https://via.placeholder.com/300' }}" alt="Vehicle Image"
                        class="vehicle-img">
                    <div class="vehicle-info">
                        <h5>{{ $vehicle->name }}</h5>
                        <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                        <p><strong>License:</strong> {{ $vehicle->license_plate }}</p>
                        <p><strong>Owner:</strong> {{ $vehicle->owner->name ?? 'N/A' }}</p>
                        <div class="btn-group">
                            <button class="btn btn-info btn-sm"
                                onclick="showVehicleDetails({{ $vehicle->id }}, '{{ $vehicle->name }}', '{{ $vehicle->model }}', '{{ $vehicle->license_plate }}', '{{ $vehicle->owner->name ?? 'N/A' }}', '{{ $vehicle->image_url ?? 'https://via.placeholder.com/300' }}')">
                                <i class="fas fa-car"></i> Details
                            </button>
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form id="delete-form-{{ $vehicle->id }}"
                                action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST"
                                style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $vehicle->id }})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <div class="mt-3">{{ $vehicles->links() }}</div> --}}
    </div>

    <div class="modal fade" id="vehicleDetailsModal" tabindex="-1" aria-labelledby="vehicleDetailsLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vehicleDetailsLabel">Vehicle Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="vehicleImage" src="" alt="Vehicle Image" class="img-fluid mb-3">
                    <p><strong>Name:</strong> <span id="vehicleName"></span></p>
                    <p><strong>Model:</strong> <span id="vehicleModel"></span></p>
                    <p><strong>License Plate:</strong> <span id="vehicleLicense"></span></p>
                    <p><strong>Fuel:</strong> <span id="vehicleOwner"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function showVehicleDetails(id, year, model, license, fuel_type, imageUrl) {
            $('#vehicleName').text(year);
            $('#vehicleModel').text(model);
            $('#vehicleLicense').text(license);
            $('#vehicleOwner').text(fuel_type);
            $('#vehicleImage').attr('src', imageUrl);

            $('#vehicleDetailsModal').modal('show');
        }

        function confirmDelete(vehicleId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + vehicleId).submit();
                }
            });
        }
    </script>
@endsection
