// public/js/categories.js

$(document).ready(function() {
    $('#categories-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.categories.index') }}',
        order: [[0, 'asc']], // Default sorting by the first column (ID) in ascending order
        columns: [
            { data: 'id', name: 'id' },
            { data: 'slug', name: 'slug' },
            { data: 'title', name: 'title' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
            }
        ]
    });
});
