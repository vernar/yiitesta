$('.cart').on('click', function (event) {
    event.preventDefault();
    $('#cart').modal('show');
});

topCartQtyUpdate = function(){
    text =  $('.total-quantity').html();
    $('.cart-product-quantity').html(text == undefined ? '(0)' : '('+text+')');
};

startCartObserver = function(){
    topCartQtyUpdate();
    $('.cart-delete').on('click', function (event) {
        event.preventDefault();
        let productid = $(this).data('productid');

        $.ajax({
            url: '/cart/del',
            data: {productid: productid},
            type: 'GET',
            success: function (res) {
                $('#cart .modal-content').html(res);
                topCartQtyUpdate();
                startCartObserver();
            },
            error: function () {
                alert('error');
            }
        });
    });


    // $('.btn-next').on('click', function (event) {
    //     event.preventDefault();
    //     $('#cart').modal('hide');
    //     $('#order').modal('show');
    // });
};

clearCart = function(event){
    event.preventDefault();
    if (confirm("Точно очистить корзину?")){
        $.ajax({
            url: '/cart/flush',
            success: function (res) {
                $('#cart .modal-content').html(res);
                startCartObserver();
            },
            error: function () {
                alert('error');
            }
        });
    }
};

createOrder = function(event){
    event.preventDefault();
    $.ajax({
        url: '/cart/order',
        success: function (res) {
            $('#order .modal-content').html(res);
            $('#cart').modal('hide');
            $('#order').modal('show');
            startCartObserver();
        },
        error: function () {
            alert('error');
        }
    });
};
$('.product-button__add').on('click', function (event) {
    event.preventDefault();
    let productid = $(this).data('productid');

    $.ajax({
        url: '/cart/add',
        data: {productid: productid},
        type: 'GET',
        success: function (res) {
            $('#cart .modal-content').html(res);
            startCartObserver();
        },
        error: function () {
            alert('error');
        }
    });
});

