$(document).ready(function () {

    $(document).on('click', '.increment-btn', function (e) {
        e.preventDefault();
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
        // alert(qty);
    });

    $(document).on('click', '.decrement-btn', function (e) {
        e.preventDefault();
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
        // alert(qty);
    });


    $(document).on('click', '.AddToCartbtn', function (e) {
        e.preventDefault();
        var product_id = $(this).val(); 
        var product_quantity = $(this).closest('.product_data').find('.input-qty').val();        
        var product_size = $('input[name="size"]:checked').val();     
        
        if (product_size === undefined) {
            showFlashMessage('Size is required.');          
            return;
        }
        $.ajax
        ({
            method:"POST",
            url:"manage_cart.php",
            data:
            {
                "prod_id":product_id,
                "quantity":product_quantity,
                "size_id":product_size,
                "scope":"add"
            },
            success: function (response) {
                if (response == 201) {
                    window.location.href = 'cart.php';
                    alertify.success('Product Added To Cart');
                    setTimeout(function() {
                        location.reload();
                    }, 10000);
                      
                    }
                else if (response == 600) {   
                    window.location.href = 'cart.php';
                    alertify.success('Product Updated in Cart');
                    setTimeout(function() {
                        location.reload();
                    }, 10000);
                      
                }
                // else if (response == 300) {                        
                //     alertify.success('Product Updated in Cart');
                // }
                else if (response == 401) {                        
                    alertify.success('Login to continue');
                    // window.location.href = 'login.php';
                }
                else if (response == 500) {                        
                    alertify.success('Something went wrong');
                }                
            }
        })
    });    

    $(document).on('click', '.remove', function (e) {
        e.preventDefault();    
        var productID = $(this).data('product-id');    
        $.ajax({
            method: "POST",
            url: "remove_cart.php", 
            data: { productID: productID },
            success: function (response) {
                if (response === 'success') { 
                    alertify.success('Product removed from cart');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                    // Update the cart item count
                    updateCartItemCount();
                } else {
                    alertify.error('Error removing the product');
                    location.reload();
                }
            }
        });
    });
    
    function showFlashMessage(message) {
        var flashMessage = $('#flash-message');
        flashMessage.text(message).show();
        setTimeout(function () {
            flashMessage.hide();
        }, 5000); 
    }
});