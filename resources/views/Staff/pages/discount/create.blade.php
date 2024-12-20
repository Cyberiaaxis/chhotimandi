@extends('Staff.layouts.staff')

@section('title', 'Create Discount')

@section('content')
<div class="container">
    <h2>Create New Discount</h2>

    <form action="{{ route('admin.discounts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="code">Discount Code</label>
            <input type="text" name="code" id="code" class="form-control" required value="{{ old('code') }}">
        </div>

        <div class="form-group">
            <label for="type">Discount Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                <option value="flat" {{ old('type') == 'flat' ? 'selected' : '' }}>Flat</option>
            </select>
        </div>

        <div class="form-group">
            <label for="value">Discount Value</label>
            <input type="number" name="value" id="value" class="form-control" required value="{{ old('value') }}" step="0.01">
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
        </div>

        <div class="form-group">
            <label for="min_amount">Minimum Order Amount</label>
            <input type="number" name="min_amount" id="min_amount" class="form-control" value="{{ old('min_amount') }}" step="0.01">
        </div>

        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">Select Product</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="is_active">Is Active?</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Discount</button>
    </form>
</div>
@endsection