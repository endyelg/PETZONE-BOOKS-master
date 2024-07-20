$(document).ready(function() {
    $('#expenses-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.expenses.index') }}',
        order: [[0, 'asc']], // Default sorting by the first column (ID) in ascending order
        columns: [
            { data: 'id', name: 'id' },
            { data: 'expense_name', name: 'expense_name' },
            { data: 'expense_date', name: 'expense_date' },
            { data: 'expense_amount', name: 'expense_amount' },
            { data: 'expense_payment', name: 'expense_payment' },
            { 
                data: 'expense_img', 
                name: 'expense_img',
                render: function(data, type, full, meta) {
                    return data ? `<img src="{{ asset('storage/') }}/${data}" alt="Expense Image" width="160" height="160">` : 'No Image';
                }
            },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false 
            }
        ]
    });
});