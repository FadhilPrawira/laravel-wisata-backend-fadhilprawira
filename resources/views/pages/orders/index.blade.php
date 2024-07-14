@extends('layouts.app')

@section('title', 'Orders')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Order</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></div>
                    <div class="breadcrumb-item">All Orders</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All category</h4>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Transaction Time</th>
                                            <th>Payment Method</th>
                                            <th>Total Price</th>
                                            <th>Total Item</th>
                                            <th>Cashier</th>
                                        </tr>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>
                                                    <a href='{{ route('orders.show', $order->id) }}'
                                                        class="btn btn-sm btn-info btn-icon">

                                                        {{ $order->transaction_time }}
                                                    </a>
                                                </td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td>{{ $order->total_price }}</td>
                                                <td>{{ $order->total_item }}</td>
                                                <td>{{ $order->cashier->name }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $orders->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
