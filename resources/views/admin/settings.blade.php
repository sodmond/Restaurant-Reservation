@extends('layouts.admin', ['title' => 'Settings', 'activePage' => 'settings'])

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="col-md-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
    </div>
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-4 text-right">
        <a class="btn btn-mv btn-sm" href='{{ route("admin.profile") }}'>
            <i class="fa fa-user"></i> My Profile
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Available Reservation Space</h6>
            </div>
            <div class="card-body" style="max-height:350px; overflow-y:scroll;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col mb-4">
                                <a class="btn btn-mv btn-sm" href="{{ route('admin.event_center', ['id' => 'new']) }}">
                                    <i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        @if (session('suc_msg'))
                            <div class="alert alert-success" role="alert"><strong>Success!</strong> {{ session('suc_msg') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Price (₦)</th>
                                        <th>Capacity</th>
                                        <th>Date Created</th>
                                        <th>Last Updated</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event_centers as $space)
                                        <?php $bookings = \App\Models\Booking::where('event_center_id', $space->id)->count(); ?>
                                        <tr>
                                            <td>{{ $space->title }}</td>
                                            <td>{{ number_format($space->price,2) }}</td>
                                            <td>{{ $space->capacity }}</td>
                                            <td>{{ $space->created_at }}</td>
                                            <td>{{ $space->updated_at }}</td>
                                            <td>
                                                <a class="btn btn-mv btn-sm" href="{{ route('admin.event_center', ['id' => $space->id]) }}">
                                                    <i class="fa fa-edit"></i></a>
                                                @if ($bookings < 1)
                                                <a class="btn btn-danger btn-sm" href="{{ route('admin.event_center.trash', ['id' => $space->id]) }}">
                                                    <i class="fa fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
