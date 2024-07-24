@extends('admin.layouts.app')
@extends('master')
@section('title', 'Bar Chart')

@section('content')
<style>
    /* Center the bar chart */
    #chart-container {
        margin: 0;
        text-align: left;
    }
    /* #barChart {
        width: 100%;
        height: 400px; 
    }  */
</style>

<div>
    <canvas id="barChart"></canvas>
</div>

@section('scripts')
<script src="{{ asset('public/js/charts.js') }}"></script> <!-- Include your charts.js file -->
@endsection
@endsection