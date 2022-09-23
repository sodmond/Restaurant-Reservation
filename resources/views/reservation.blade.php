@extends('layouts.app', ['title' => 'Reservation'])

@section('content')
<section class="contact-from-section spad" id="booking">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Confirm Reservations</h2>
                    <p>Fill out the form below to complete reservations for a table.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if (count($errors))
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Error validating data.<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('suc_msg'))
                    <div class="alert alert-success" role="alert"><strong>Success!</strong> {{ session('suc_msg') }}</div>
                @endif
                @if (session('err_msg'))
                    <div class="alert alert-danger" role="alert"><strong>Oops!</strong> {{ session('err_msg') }}</div>
                @endif
                <form action="{{ route('booking.confirm') }}" method="POST" class="comment-form contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" placeholder="Your Name" required value="{{ old('name') }}">
                        </div>
                        <div class="col-lg-4">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Your Email" required value="{{ old('email') }}">
                        </div>
                        <div class="col-lg-4">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" placeholder="Your Phone Number" required value="{{ old('phone') }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="event_center">Reservation Space</label>
                            <input type="text" name="event_center" id="event_center" value="{{ ucwords($space['title']) }}" readonly>
                            <input type="hidden" name="event_center_id" value="{{$availablity['event_center']}}">
                        </div>
                        <div class="col-lg-6">
                            <label for="event_center">Price</label>
                            <input type="number" name="price" id="price" value="{{ $space['price'] }}" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label for="event_date">Reservation Date</label>
                            <input type="text" name="event_date" id="event_date" value="{{ $availablity['event_date'] }}" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label for="scheduled_time">Scheduled Time (24hr)</label>
                            <input type="text" name="scheduled_time" id="scheduled_time" value="{{ $availablity['scheduled_time'] }}" readonly>
                        </div>
                        <div class="col-lg-12 my-4">
                            <label for="event_date">Terms and Condition</label>
                            <textarea placeholder="Messages"><?php echo file_get_contents(asset('terms-conditions.txt')); ?>
                            </textarea>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="agreement" id="agreement" required>
                                        <label class="form-check-label" for="agreement">I agree to the terms and condition above</label>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="site-btn">Pay ₦{{ number_format($space['price']/2) }}</button>
                            <a href="{{ url('/') }}" class="site-btn">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection