@extends('layouts.admin', ['title' => 'Payments', 'activePage' => 'payments'])

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Payments</h1>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">List of All Payments</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Amount (₦)</th>
                                        <th>Reference</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $payment)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ number_format($payment->amount,2) }}</td>
                                            <td>{{ $payment->reference }}</td>
                                            <td>{{ $payment->status }}</td>
                                            <td>{{ $payment->created_at }}</td>
                                            <td><a class="btn btn-mv btn-sm" href="{{ route('admin.bookings.view', ['id' => $payment->booking_id]) }}">
                                                <i class="fa fa-eye"></i>
                                            </a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center">{{ $transactions->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
