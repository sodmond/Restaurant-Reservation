@extends('layouts.admin', ['title' => 'Bookings', 'activePage' => 'bookings'])

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Reservations</h1>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">{{ isset($search) ? 'Search results for "'.$search.'"' : 'List of All Reservations' }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Reserved Space</th>
                                        <th>Space Renter</th>
                                        <th>Reserved Date & Time</th>
                                        <th>Date Created</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <?php 
                                        $e = new \App\Models\Booking;
                                        $spaceName = $e->getEventSpaceName($booking->event_center_id);
                                        ?>
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>{{ $spaceName }}</td>
                                            <td>{{ $booking->name }}</td>
                                            <td>{{ $booking->event_date. ' @ ' .$booking->scheduled_time }}</td>
                                            <td>{{ $booking->created_at }}</td>
                                            <td><a class="btn btn-mv btn-sm" href="{{ route('admin.bookings.view', ['id' => $booking->id]) }}">
                                                <i class="fa fa-eye"></i>
                                            </a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center">{{ $bookings->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
