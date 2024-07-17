@extends('admin.layouts.app')

@section('title', 'Admin-Charts bargraph')

@section('content')

<style>
    /* Center the bar chart */
    #chart-container {
        margin: 0 auto;
        text-align: center;
    }
</style>

<div id="barchart-container">
    <canvas id="barChart"></canvas>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('public/js/piechart.js') }}"></script>
  
@endsection
