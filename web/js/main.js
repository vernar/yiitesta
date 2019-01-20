$('.cart').on('click', function (event) {
    event.preventDefault();
    $('#cart').modal('show');
});

startCartObserver = function(){
    $('.product-button__del').on('click', function (event) {
        event.preventDefault();
        let productid = $(this).data('productid');

        $.ajax({
            url: '/cart/del',
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

    $('.btn-danger').on('click', function (event) {
        event.preventDefault();
        $.ajax({
            url: '/cart/flush',
            success: function (res) {
                $('#cart .modal-content').html(res);
            },
            error: function () {
                alert('error');
            }
        });
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

