$(document).ready(function() {

// Expenses Form Validation
    $("#expenseForm").validate({
        rules: {
            expense_name: {
                required: true,
                minlength: 3
            },
            expense_date: {
                required: true,
                date: true
            },
            expense_amount: {
                required: true,
                number: true
            },
            expense_payment: {
                required: true,
                minlength: 3
            },
            expense_img: {
                required: true,
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            expense_name: {
                required: "The expense name field is required",
                minlength: "The expense name must be at least 3 characters long"
            },
            expense_date: {
                required: "The expense date field is required",
                date: "Please enter a valid date"
            },
            expense_amount: {
                required: "The expense amount field is required",
                number: "The expense amount must be a number"
            },
            expense_payment: {
                required: "The expense payment field is required",
                minlength: "The expense payment must be at least 3 characters long"
            },
            expense_img: {
                required: "The expense image field is required",
                extension: "Please upload a valid image file (jpg, jpeg, png, gif)"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

// Expenses Edit Form Validation
    $("#expenseEditForm").validate({
        rules: {
            expense_name: {
                required: true,
                minlength: 3
            },
            expense_date: {
                required: true,
                date: true
            },
            expense_amount: {
                required: true,
                number: true
            },
            expense_payment: {
                required: true,
                minlength: 3
            },
            expense_img: {
                required: "The expense image field is required",
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            expense_name: {
                required: "The expense name field is required",
                minlength: "The expense name must be at least 3 characters long"
            },
            expense_date: {
                required: "The expense date field is required",
                date: "Please enter a valid date"
            },
            expense_amount: {
                required: "The expense amount field is required",
                number: "The expense amount must be a number"
            },
            expense_payment: {
                required: "The expense payment field is required",
                minlength: "The expense payment must be at least 3 characters long"
            },
            expense_img: {
                required: "The expense image field is required",
                extension: "Please upload a valid image file (jpg, jpeg, png, gif)"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
