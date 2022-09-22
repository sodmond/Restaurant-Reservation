@extends('layouts.admin', ['title' => 'Reservation Space', 'activePage' => 'settings'])

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Reservation Space</h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">{{ $newStatus ?? 'Modify Reservation Space' }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
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
                        <form action="{{ route('admin.event_center.ops') }}" method="post">
                            @csrf
                            @isset ($event_center->id)
                            <div class="row mb-4">
                                <div class="col-3 text-right">ID</div>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="event_center_id" id="event_center_id" value="{{ $event_center->id }}" readonly>
                                </div>
                            </div>
                            @endisset
                            <div class="row mb-4">
                                <div class="col-3 text-right">Title</div>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $event_center->title ?? old('title') }}" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-3 text-right">Price</div>
                                <div class="col-8">
                                    <input type="number" class="form-control" name="price" id="price" value="{{ $event_center->price ?? old('price') }}" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-3 text-right">Capacity</div>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="capacity" id="capacity" value="{{ $event_center->capacity ?? old('capacity') }}" required>
                                </div>
                            </div>
                            @isset ($event_center->id)
                            <div class="row mb-4">
                                <div class="col-3 text-right">Status</div>
                                <div class="col-8">
                                    <select class="form-control" name="status" id="status" required>
                                        <option selected> - - - {{ $event_center->status == true ? 'Available' : 'Unavailable' }} - - - </option>
                                        <option value="1">Available</option>
                                        <option value="0">Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            @endisset
                            <div class="row mb-4">
                                <div class="col-lg-8 offset-lg-3">
                                    <button type="submit" class="btn btn-mv">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
