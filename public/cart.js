$(document).ready(function(){
    function getTotal(){
        $.ajax({
            type:'post',
            url:'/cart',
            success:function(response) {
              $("#total_items").fadeOut(function() {
                  $("#total_items").text(response).fadeIn();
              });
            }
        });
    }
    getTotal();
    function displayInfo(){
        $("#info").text("Article ajouté");
        $("#info").addClass('show');
        setTimeout(hideInfo, 3000);
    }
    function hideInfo(){
        $("#info").removeClass('show');
    }
    $(".add_cart").click(function() {
        $.ajax({
            type:'post',
            url:'/cart/'+this.id+'/add',
            success:function() {
                getTotal();
                displayInfo();
            }
        });
        return false;
    });
    $(".quantity").change(function() {
        $.ajax({
            type:'post',
            url:'/cart/'+this.id+'/edit',
            data:{
              quantity: this.value
            },
            success:function() {
                getTotal();
                $("#reload").removeClass('d-none');
            }
        });
    });
});
