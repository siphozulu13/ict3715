/*
 * Require jquery3.1.1.js
 */


$(document).ready(function(){
    //alert("hello");
    
    // show the booking for a patient
    show_patient_booking();
    function show_patient_booking(){
        $.ajax({
            url : "/model/action.php",
            method : "POST",
            data : {show_patient_booking:1},
            success : function(data){
                $("#view_booking").html(data);
            }
        });
    }
    
    // js code to enable the booking functionality 
    $("body").delegate(".btnBook", "click", function(event){
        event.preventDefault();
        var booking_id = $(this).attr('booking_id');
        $.ajax({
           url:  "/model/action.php",
           method: "POST",
           data:   {create_booking:1,booking_id:booking_id},
           success: function(data){
               $("#booking_message").html(data);
           }
        });
    });
    
    // js code to process the deletion of the booking
    $("body").delegate(".delete_button", "click", function(event){
        event.preventDefault();
        var delete_id = $(this).attr('delete_id');
        $.ajax({
           url:  "/model/action.php",
           method: "POST",
           data:   {deleteBooking:1,delete_id:delete_id},
           success: function(data){
               $("#booking_cart_message").html(data);
               show_patient_booking();
           }
        });
    });
    
    
    
    // js code to proces the update of the booking 
    $("body").delegate(".update_button", "click", function(event){
        event.preventDefault();
        var update_id = $(this).attr('update_id');
        var booking_time = $("#booking_time").val();
        var booking_doctor = $("#booking_doctor").val();
        $.ajax({
           url:  "/model/action.php",
           method: "POST",
           data:   {updateBooking:1,update_id:update_id,booking_time:booking_time,booking_doctor:booking_doctor},
           success: function(data){
               $("#booking_cart_message").html(data);
           }
        });
    });
    
    
    // js code to add product to cart 
    $("body").delegate(".supplement", "click", function(event){
        event.preventDefault();
        var product_id = $(this).attr('product_id');
        //alert(product_id);
        $.ajax({
           url:  "/model/action.php",
           method: "POST",
           data:   {addToCart:1,product_id:product_id},
           success: function(data){
               $("#supplement_cart_msg").html(data);
               cart_count();
           }
        });
    });
    
    cart_count();
    function cart_count(){
        $.ajax({
            url : "/model/action.php",
            method : "POST",
            data : {cart_count:1},
            success : function(data){
                $("#cart_count").html(data);
            }
        });
    }
    
    cart_view();
    function cart_view(){
        //event.preventDefault();
        $.ajax({
            url : "/model/action.php",
            method : "POST",
            data : {cart_view:1},
            success : function(data){
                $("#cart_view").html(data);
            }
        });
    }
    
    // code to edit quantity and calculate
    $("body").delegate(".qty","keyup",function(){ 
        var product_id = $(this).attr("product_id");
        var quantity = $("#qty-"+product_id).val();
        var price = $("#price-"+product_id).val();
        var total = quantity * price;
        //alert(total);
        $("#total-"+product_id).val(total);
    });
    
    
    // JavaScript to remove the item from the cart
    $("body").delegate(".delete","click",function(event){ 
        event.preventDefault();
        var product_id = $(this).attr("delete_id");
        //alert(product_id);
        $.ajax({
        url : "/model/action.php",
        method : "POST",
        data : {deleteFromCart:1,product_id:product_id},
        success : function(data){
            $("#cart_msg").html(data);
            cart_view(); // update the display products
            cart_count(); // update the count of the cart
        }
    });
    });
    
    // js code for updates 
    $("body").delegate(".update","click",function(event){
        event.preventDefault();
        var product_id = $(this).attr("update_id");
        var quantity = $("#qty-"+product_id).val();
        var price = $("#price-"+product_id).val();
        var total = $("#total-"+product_id).val();
        $.ajax({
            url : "/model/action.php",
            method : "POST",
            data : {updateSupplement:1,product_id:product_id,quantity:quantity,price:price,total:total},
            success : function(data){
                $("#cart_msg").html(data);
                cart_view(); // update the display products
            }
        });
    });
    
    
});
