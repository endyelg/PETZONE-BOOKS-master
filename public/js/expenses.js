// expenses.js
$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/expenses", // Update with your expenses API endpoint
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                console.log(value);

                // Create table row
                var tr = $("<tr>");

                // Append table data cells
                tr.append($("<td>").html(value.id)); // Id
                tr.append($("<td>").html(value.expense_name)); // Expense Name
                tr.append($("<td>").html(value.expense_date)); // Date
                tr.append($("<td>").html(value.expense_amount)); // Expense Amount
                tr.append($("<td>").html(value.payment || 'No Payment Info')); // Payment, default if missing
                var img = value.expense_img ? "<img src='/storage/" + value.expense_img + "' width='50'/>" : 'No Image';
                tr.append($("<td>").html(img)); // Expense Image

                // Action buttons
                tr.append("<td align='center'><a href='/admin/expenses/" + value.id + "/edit' class='btn btn-primary' title='Edit'><i class='fas fa-edit' aria-hidden='true' style='font-size:24px; color:blue'></i></a></td>");
                tr.append("<td align='center'><a href='#' class='btn btn-danger deletebtn' data-id='" + value.id + "' title='Delete'><i class='fa fa-trash' style='font-size:24px; color:red'></i></a></td>");

                // Append the row to the table body
                $("#cbody").append(tr);
            });

            // Attach click event handlers for delete buttons
            $(".deletebtn").on('click', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                if (confirm("Are you sure you want to delete this expense?")) {
                    $.ajax({
                        type: "DELETE",
                        url: "/api/expenses/" + id, // Update with your delete API endpoint
                        dataType: 'json',
                        success: function (response) {
                            alert("Expense deleted successfully.");
                            location.reload(); // Reload the page to reflect changes
                        },
                        error: function () {
                            alert("Error deleting expense.");
                        }
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
        e.preventDefault(); // Prevent the default form submission

        // Create a FormData object to handle file uploads
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: $(this).attr('action'), // Get the action URL from the form
            data: formData,
            contentType: false, // Let jQuery set the content type
            processData: false, // Prevent jQuery from processing the data
            dataType: 'json',
            success: function (response) {
                alert("Expense added successfully.");
                // Optionally, you can redirect the user or clear the form
                // location.href = '/admin/expenses'; // Redirect to the expenses list
                $('#expenseForm')[0].reset(); // Clear the form
            },
            error: function (xhr, status, error) {
                console.error("Error adding expense:", error);
                alert("Error adding expense. Please try again.");
            }
        });
    });
});

// edit-expense.js

$(document).ready(function () {
    $('#expenseEditForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Create a FormData object to handle file uploads
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: $(this).attr('action'), // Get the action URL from the form
            data: formData,
            contentType: false, // Let jQuery set the content type
            processData: false, // Prevent jQuery from processing the data
            dataType: 'json',
            success: function (response) {
                alert("Expense updated successfully.");
                // Optionally, you can redirect the user or clear the form
                // location.href = '/admin/expenses'; // Redirect to the expenses list
                $('#expenseEditForm')[0].reset(); // Clear the form
            },
            error: function (xhr, status, error) {
                console.error("Error updating expense:", error);
                alert("Error updating expense. Please try again.");
            }
        });
    });
});

});
