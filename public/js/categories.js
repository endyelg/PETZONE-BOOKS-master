$(document).ready(function() {
    $('#categories-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: categoriesIndexUrl, // Use the URL passed from Blade
        columns: [
            { data: 'id', name: 'id' },
            { data: 'slug', name: 'slug', title: 'Website Genre' },
            { data: 'title', name: 'title', title: 'Category' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        dom: 'Bfrtip',
        buttons: [
            'create', 'export', 'print', 'reset', 'reload'
        ]
    });
});