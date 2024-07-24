@extends('admin.layouts.app')
@extends('master')
@section('title', 'Line Chart')

@section('content')
<style>
    /* Center the line chart */
    #chart-container {
        margin: 0 auto;
        text-align: center;
    }
    /* #lineChart {
        width: 100%; 
        height: 400px; 
    } */
</style>

<div id="chart-container">
    <canvas id="lineChart"></canvas>
</div>

@section('scripts')
<script src="{{ asset('public/js/charts.js') }}"></script> <!-- Include your charts.js file -->
@endsection
@endsection