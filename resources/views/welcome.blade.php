@extends('layouts.app', ['title' => 'Reservation'])

@section('content')
<section class="contact-from-section spad" id="booking" style="background:#F9FAFC;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 pt-4">
                <div class="section-title" style="text-align:left;">
                    <h2 style="font-size:3.8em">Trust us...!<br>Your stay<br>will be great!</h2>
                    <span>P.S.A: 50% upfront payment is required and mandatory<br> to reserve a table. Kindly use the form to pay for your<br> 
                        reservation.<br><br>
                        We look forward to seeing you at Lobstercrib Restaurant.</span>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow py-4">
                            <div class="card-body">
                                <h2 class="h4">Reservation Form</h2>
                                <p>Fill out the form below to check availability of a table space.</p>
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
                                <form action="{{ route('booking.check') }}" class="comment-form contact-form" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="event_center">Choose Reservation Sit</label>
                                            <select name="event_center" id="event_center" required>
                                                <option value="">- - - Select Sit Type - - -</option>
                                                @foreach ($event_centers as $space)
                                                    <option value="{{$space->id}}">{{ ucwords($space->title) .' @ ₦'. number_format($space->price) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-12">
                                            <?php 
                                            $today = date('Y-m-d');
                                            $tomorrow = date('Y-m-d', strtotime($today . ' +1 day'))
                                            ?>
                                            <label for="event_date">Schedule Date</label>
                                            <input type="date" name="event_date" id="event_date" min="{{ $tomorrow }}" placeholder="mm/dd/yyyy" required>
                                        </div>
                                        <div class="col-lg-12">
                                            <?php 
                                            $today = date('Y-m-d');
                                            $tomorrow = date('Y-m-d', strtotime($today . ' +1 day'))
                                            ?>
                                            <label for="scheduled_time">Schedule Time</label>
                                            <select name="scheduled_time" id="scheduled_time" required>
                                                <option selected> - - - Select Time - - - </option>
                                                <option value="09:00 AM">09:00 AM</option>
                                                <option value="12:00 PM">12:00 PM</option>
                                                <option value="15:00 PM">03:00 PM</option>
                                                <option value="18:00 PM">06:00 PM</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="site-btn">Check Availability</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('custom-script')
    <script>
        $(document).ready(function() {
            var event_date = $('#event_date');
            if (event_date.attr('type') != 'date') { 
                //alert('Worked!');
                event_date.datepicker({
                    minDate: +1,
                });
            }
            //$('input[type=date]').on('load', function(){ alert('Worked!') });
        });
    </script>
@endpush
@endsection