$(document).ready(function () {
    $('#expenses-table').DataTable();

    $.ajax({
        type: "GET",
        url: "/api/expenses",
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                console.log(value);

                var tr = $("<tr>");

                tr.append($("<td>").html(value.id)); 
                tr.append($("<td>").html(value.expense_name)); 
                tr.append($("<td>").html(value.expense_date)); 
                tr.append($("<td>").html(value.expense_amount)); 
                tr.append($("<td>").html(value.payment || 'No Payment Info')); 
                var img = value.expense_img ? "<img src='/storage/" + value.expense_img + "' width='50'/>" : 'No Image';
                tr.append($("<td>").html(img));
                tr.append("<td align='center'><a href='/admin/expenses/" + value.id + "/edit' class='btn btn-primary' title='Edit'><i class='fas fa-edit' aria-hidden='true' style='font-size:24px; color:blue'></i></a></td>");
                tr.append("<td align='center'><a href='#' class='btn btn-danger deletebtn' data-id='" + value.id + "' title='Delete'><i class='fa fa-trash' style='font-size:24px; color:red'></i></a></td>");

                $("##expenses-table tbody").append(tr);
            });

// delete-expense.js
            $(".deletebtn").on('click', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                {
                    $.ajax({
                        type: "DELETE",
                        url: "/api/expenses/" + id, 
                        dataType: 'json',
                        success: function (response) {
                            alert("Expense deleted successfully.");
                            location.reload();
                        },
                    });
                }
            });
        },
        error: function () {
            console.log('AJAX load did not work');
            alert("Error loading expenses data.");
        }
    });

    // add-expense.js

    $(document).ready(function () {
        $('#expenseForm').on('submit', function (e) {
            e.preventDefault();
    
            var formData = new FormData(this);
    
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                contentType: false, 
                processData: false,
                dataType: 'json',
                success: function (response) {
                    alert("Expense added successfully.");
    
                    var tr = $("<tr>");
                    tr.append($("<td>").html(response.id)); 
                    tr.append($("<td>").html(response.expense_name)); 
                    tr.append($("<td>").html(response.expense_date)); 
                    tr.append($("<td>").html(response.expense_amount));
                    tr.append($("<td>").html(response.expense_payment || 'No Payment Info')); 
                    var img = response.expense_img ? "<img src='/storage/" + response.expense_img + "' width='50'/>" : 'No Image';
                    tr.append($("<td>").html(img)); 
                    tr.append("<td align='center'><a href='/admin/expenses/" + response.id + "/edit' class='btn btn-primary' title='Edit'><i class='fas fa-edit' aria-hidden='true' style='font-size:24px; color:blue'></i></a></td>");
                    tr.append("<td align='center'><a href='#' class='btn btn-danger deletebtn' data-id='" + response.id + "' title='Delete'><i class='fa fa-trash' style='font-size:24px; color:red'></i></a></td>");
    
                    $("#cbody").append(tr);
    
                    $('#expenseForm')[0].reset(); 
                },
            });
        });
    });
    

// update-expense.js

$(document).ready(function () {
    $('#expenseEditForm').on('submit', function (e) {
        e.preventDefault(); 

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: $(this).attr('action'), 
            data: formData,
            contentType: false, 
            processData: false, 
            dataType: 'json',
            success: function (response) {
                alert("Expense updated successfully.");

                var row = $("tr[data-id='" + response.id + "']");
                
                row.find("td:eq(0)").html(response.expense_name); 
                row.find("td:eq(1)").html(response.expense_date); 
                row.find("td:eq(2)").html(response.expense_amount); 
                row.find("td:eq(3)").html(response.expense_payment); 
                var img = response.expense_img ? "<img src='/storage/" + response.expense_img + "' width='50'/>" : 'No Image';
                row.find("td:eq(4)").html(img); 

                $('#expenseEditForm')[0].reset(); 
            },
        });
    });
});
});
