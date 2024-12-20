@extends('Staff.layouts.staff')

@section('title', 'Order Management')

@section('content')
<div class="container">
    <!-- Display Success Message if exists -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Flexbox container for buttons -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Left-aligned content (you can add other content here if needed) -->
        <div>
            <h1>Orders</h1>
        </div>

        <!-- Right-aligned Create Order Button with Icon -->
        <a href="{{ route('orders.create') }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Create New Order">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <!-- Table for displaying orders -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Tracking Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->status }}</td>
                <td>${{ number_format($order->final_amount, 2) }}</td>
                <td>{{ $order->tracking_number }}</td>
                <td>
                    <!-- Edit Button with Icon -->
                    <a href="{{ route('orders.edit', $order->id) }}"
                        class="btn btn-primary"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Edit Order">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="pagination">
        {{ $orders->links() }}
    </div>
</div>
@endsection