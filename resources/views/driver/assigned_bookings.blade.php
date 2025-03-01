@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Assigned Bookings</h2>

        @if($assignedRides->isEmpty())
            <p>No assigned rides yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Ride ID</th>
                        <th>Pickup</th>
                        <th>Dropoff</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignedRides as $ride)
                        <tr>
                            <td>{{ $ride->id }}</td>
                            <td>{{ $ride->pickup_location }}</td>
                            <td>{{ $ride->dropoff_location }}</td>
                            <td>{{ ucfirst($ride->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
