@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Manage Trips</h2>

        @if($rides->isEmpty())
            <p>No trips assigned yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Ride ID</th>
                        <th>Pickup Location</th>
                        <th>Dropoff Location</th>
                        <th>Status</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rides as $ride)
                        <tr>
                            <td>{{ $ride->id }}</td>
                            <td>{{ $ride->pickup_location }}</td>
                            <td>{{ $ride->dropoff_location }}</td>
                            <td>{{ ucfirst($ride->status) }}</td>
                            <td>{{ $ride->start_time }}</td>
                            <td>{{ $ride->end_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
