@extends('Staff.layouts.staff')

@section('title', 'Discounts List')

@section('content')
<div class="container">
    <h2>Discounts List</h2>

    <!-- Success Message -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Button to Create New Discount -->
    <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary mb-3" data-bs-toggle="tooltip" title="Create a new discount">
        <i class="fas fa-plus-circle"></i>
    </a>

    <!-- Discounts Table (Responsive) -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Discount Code</th>
                    <th>Discount Type</th>
                    <th>Value</th>
                    <th>Min Order Amount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($discounts as $discount)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $discount->code }}</td>
                    <td>{{ ucfirst($discount->type) }}</td>
                    <td>
                        @if ($discount->type == 'percentage')
                        {{ $discount->value }}%
                        @else
                        ${{ number_format($discount->value, 2) }}
                        @endif
                    </td>
                    <td>${{ number_format($discount->min_amount, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i> <!-- Edit Icon -->
                        </a>

                        <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this discount?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                <i class="fas fa-trash-alt"></i> <!-- Trash Icon -->
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No discounts available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $discounts->links() }}
    </div>
</div>
@endsection