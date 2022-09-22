@extends('layouts.admin', ['title' => 'Bookings', 'activePage' => 'bookings'])

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Booking</h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Booking Details</h6>
            </div>
            <div class="card-body">
                @if (count($errors))
                    <div class="alert alert-danger mb-2">
                        <strong>Whoops!</strong> Error validating data.<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert"><strong>Success!</strong> {{ session('success') }}</div>
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $booking->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Event Space</th>
                                        <td><?php
                                            $e = new \App\Models\Booking;
                                            $spaceName = $e->getEventSpaceName($booking->event_center_id);
                                            echo $spaceName;
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <th>Reserved Date & Time</th>
                                        <td>{{ $booking->event_date. ' @ ' .$booking->scheduled_time }}</td>
                                    </tr>
                                    <tr>
                                        <th>Renter Name</th>
                                        <td>{{ $booking->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $booking->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date Created</th>
                                        <td>{{ $booking->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($booking->status == true)
                                                <span class="text-success fw-normal">Booked</span>
                                            @else
                                                <span class="text-danger">Cancelled</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="h5">Payment</p>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Amount</th>
                                        <td>₦{{ number_format($payment->amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Reference</th>
                                        <td>{{ $payment->reference }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $payment->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            @if ($booking->status == true)
                            <input type="hidden" id="cancelBooking" value="{{ route('admin.bookings.cancel', ['id' => $booking->id]) }}">
                                <button type="button" class="btn btn-danger" id="cancelBookingBtn">
                                    <i class="fa fa-times"></i> Cancel Booking
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-script')
    <script>
        $('#cancelBookingBtn').click(function(){
            var url = $('#cancelBooking').val();
            var cancel = confirm("Do you want to proceed to cancel this booking?");
            if (cancel == true) {
                window.location.href = url;
            }
            //if (cancel == false) alert('Not Confirmed!');
        });
    </script>
@endpush
@endsection
