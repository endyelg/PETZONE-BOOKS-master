$(document).ready(function() {

// Supplier Form Validation
    $("#supplierForm").validate({
        rules: {
            supplier_name: {
                required: true,
                minlength: 3
            },
            contact_number: {
                required: true,
                digits: true
            },
            address: {
                required: true,
                minlength: 3
            },
            image_path: {
                required: true
            },
            prod_id: {
                required: true
            }
        },
        messages: {
            supplier_name: {
                required: "The supplier name field is required",
                minlength: "The supplier name must be at least 3 characters"
            },
            contact_number: {
                required: "The contact number field is required",
                digits: "The contact number must be a number"
            },
            address: {
                required: "The address field is required",
                minlength: "The address must be at least 3 characters"
            },
            image_path: {
                required: "The image path field is required"
            },
            prod_id: {
                required: "The product field is required"
            }
        },
        submitHandler: function(form) {
            form.submit(); 
        }
    });


// Supplier Edit Form Validation
    $("#supplierEditForm").validate({
        rules: {
            supplier_name: {
                required: true,
                minlength: 3
            },
            contact_number: {
                required: true,
                digits: true
            },
            address: {
                required: true,
                minlength: 5
            },
            image_path: {
                required: true
            },
            prod_id: {
                required: true
            }
        },
        messages: {
            supplier_name: {
                required: "The supplier name field is required",
                minlength: "The supplier name must be at least 3 characters"
            },
            contact_number: {
                required: "The contact number field is required",
                digits: "The contact number must be a number"
            },
            address: {
                required: "The address field is required",
                minlength: "The address must be at least 5 characters"
            },
            image_path: {
                required: "The image path field is required"
            },
            prod_id: {
                required: "The product field is required"
            }
        },
        submitHandler: function(form) {
            form.submit(); 
        }
    });
});
