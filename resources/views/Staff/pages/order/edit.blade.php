@extends('Staff.layouts.staff')

@section('title', 'Order modify')

@section('content')
<div class="container">
    <h1>Edit Order</h1>
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>
        <div class="form-group">
            <label for="shipping_status">Shipping Status</label>
            <select name="shipping_status" id="shipping_status" class="form-control" required>
                <option value="pending" {{ $order->shipping_status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_transit" {{ $order->shipping_status == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                <option value="delivered" {{ $order->shipping_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update Order</button>
    </form>
</div>
@endsection