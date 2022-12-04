$(document).ready(function() {

    loadcart();
    loadwishlist();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadcart()
    {
        $.ajax({
            method: "get",
            url: "/carregar-produtos-carrinho",
            success: function (response) {
              $('.carrinho-count').html('');
              $('.carrinho-count').html(response.count);
            }
        });
    }

    function loadwishlist()
    {
        $.ajax({
            method: "get",
            url: "/carregar-produtos-listadesejos",
            success: function (response) {
              $('.listadesejos-count').html('');
              $('.listadesejos-count').html(response.count);
            }
        });
    }

    $('.addToCartBtn').click(function(e) {
        e.preventDefault();

        var produto_id = $(this).closest('.produto_data').find('.prod_id').val();
        var produto_qty = $(this).closest('.produto_data').find('.qty-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "post",
            url: "/adicionar-ao-carrinho",
            data: {
                'produto_id': produto_id,
                'produto_qty': produto_qty,
            },
            success: function(response) {
                swal(response.status);
                loadcart();
            }
        });
    });

    $('.addToWishlist').click(function (e) {
        e.preventDefault();
        var produto_id = $(this).closest('.produto_data').find('.prod_id').val();

        $.ajax({
            method: "post",
            url: "/adicionar-a-listadedesejos",
            data: {
                'produto_id': produto_id,
            },
            success: function(response) {
                swal(response.status);
                loadwishlist();
            }
        });
    });

    $('.increment-btn').click(function(e) {
        e.preventDefault();

        var inc_value = $(this).closest('.produto_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.produto_data').find('.qty-input').val(value);
        }
    });

    $('.decrement-btn').click(function(e) {
        e.preventDefault();

        var dec_value = $(this).closest('.produto_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.produto_data').find('.qty-input').val(value);
        }
    });



     $('.delete-cart-item').click(function (e){
        e.preventDefault();

        var prod_id = $(this).closest('.produto_data').find('.prod_id').val();
        $.ajax({
            method: "post",
            url: "delete-cart-item",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                window.location.reload();
              swal("",response.status, "success");
            }
        });
    });

    $('.remove-listadesejos-item').click (function (e) {
        e.preventDefault();
        var prod_id = $(this).closest('.produto_data').find('.prod_id').val();

        $.ajax({
            method: "post",
            url: "delete-item-listadesejos",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                window.location.reload();
              swal("",response.status, "success");
            }
        });
    });

    $('.changeQuantidade') .click (function (e) {
        e.preventDefault();

        var prod_id = $(this).closest('.produto_data').find('.prod_id').val();
        var qty = $(this).closest('.produto_data').find('.qty-input').val();
        data = {
            'prod_id' : prod_id,
            'prod_qty' : qty,
        }

        $.ajax({
            method: "post",
            url: "atualizar-carrinho",
            data: data,
            success: function (response) {
                $('.cartitems').load(location.href + " .cartitems");
                // window.location.reload();
            }
        });
    });

});
