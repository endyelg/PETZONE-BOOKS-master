@extends('admin.layouts.app')

@section('title', 'Admin-Expenses')

@section('content')
<!-- Expenses list start -->
<div class="main-content-inner">
    <div class="row">
        <div class="table-responsive">
            <table id="ctable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Expense Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Expense Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cbody">
                    @foreach($expenses as $expense) {{-- Loop through each expense --}}
                        <tr>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->expense_name }}</td>
                            <td>{{ $expense->expense_date }}</td>
                            <td>{{ $expense->expense_amount }}</td>
                            <td>{{ $expense->expense_payment }}</td> {{-- Added Payment column --}}
                            <td>
                            @if($expense->expense_img)
                                <img src="{{ asset('storage/' . $expense->expense_img) }}" alt="Expense Image" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                            <td>
                                <a href="{{ route('admin.expenses.edit', $expense->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Expenses list end -->
@endsection
