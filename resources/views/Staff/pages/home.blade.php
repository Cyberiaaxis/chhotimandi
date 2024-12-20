@extends('Staff.layouts.staff')

@section('title', 'Dashboard') <!-- Sets the title of the page dynamically to 'Dashboard' -->

@section('content')
<!-- <div class="container p-0 m-0"> <!-- Container for the content, with padding and margin removed for a more compact layout -->
<!-- Dashboard Heading -->
<h5 class="">E-commerce Dashboard</h5> <!-- A heading for the E-commerce Dashboard -->

<!-- Chart Container: Flexbox layout to arrange the charts side by side -->
<div class="row">
    <!-- Sales Overview Chart: Chart for displaying sales data -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
        <!-- Chart Title -->
        <h6>Sales Overview</h6> <!-- Title for the sales chart -->
        <!-- Canvas for the Sales Chart -->
        <canvas id="pieChart" class="chart-canvas"></canvas> <!-- The canvas element where the chart will be rendered (e.g., Pie chart) -->
    </div>

    <!-- Orders Overview Chart: Chart for displaying orders data -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
        <!-- Chart Title -->
        <h6>Orders Overview</h6> <!-- Title for the orders chart -->
        <!-- Canvas for the Orders Chart -->
        <canvas id="ordersChart" class="chart-canvas"></canvas> <!-- The canvas element where the chart will be rendered (e.g., Bar chart) -->
    </div>
</div>
</div> -->
@endsection