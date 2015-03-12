/*
 * --------------- Config plugins ----------------
 */

var dataSearch;

var initImageZoom = function() {
    jQuery('.product-main-image').zoom({
        url: jQuery('.product-main-image img').attr('data-BigImgSrc')
    });
}

var initTouchspin = function() {
    jQuery(".product-quantity .form-control").TouchSpin({
        buttondown_class: "btn quantity-down",
        buttonup_class: "btn quantity-up",
        min: 0,
        max: 100,
        step: 1,
        decimals: 0,
        boostat: 5,
        maxboostedstep: 10
    });
    jQuery(".quantity-down").html("<i class='fa fa-angle-down'></i>");
    jQuery(".quantity-up").html("<i class='fa fa-angle-up'></i>");

    jQuery('.product-quantity-change').on('touchspin.on.stopspin', function () {
        $.ajax({
            type: 'GET',
            url: jQuery(this).attr('data-url') + '/' + jQuery(this).val(),
            //data: { 'quantity': jQuery(this).val() },
            dataType: "JSON",
            success: function(response) {
                if(!response.success)
                    alert('Hubo un error intentando cambiar la cantidad, intente de nuevo!');
            }
        });
    });
}

var handleFancybox = function() {
    if (!jQuery.fancybox) {
        return;
    }

    jQuery(".fancybox-fast-view").fancybox();

    if (jQuery(".fancybox-button").size() > 0) {
        jQuery(".fancybox-button").fancybox({
            groupAttr: 'data-rel',
            prevEffect: 'none',
            nextEffect: 'none',
            closeBtn: true,
            helpers: {
                title: {
                    type: 'inside'
                }
            }
        });

        $('.fancybox-video').fancybox({
            type: 'iframe'
        });
    }
}

var initSliderRange = function() {
    jQuery("#slider-range-price").slider({
        range: true,
        min: 0,
        max: 9999,
        values: [ 1, 9999 ],
        slide: function( event, ui ) {
            jQuery( "#priceRange" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        },
        change: function(event, ui) {
            // when the user change the slider
            var firstValue = ui.values[0];
            var secondValue = ui.values[1];
        },
        stop: function(event, ui) {
            // when the user stopped changing the slider
            dataSearch = {
                /*'categories': jQuery('#categories').val() ? jQuery('#categories').val() : [], 
                'conditionsProducts':  jQuery('#conditionsProducts').val(),
                'conditionsClassifieds':  jQuery('#conditionsClassifieds').val(),
                'classifiedType':  jQuery('#classifiedType').val(),
                'cityId':  jQuery('#cityId').val(),*/
                //'operator':  jQuery('#operator').val(),
                //'price':  jQuery('#price').val(),
                'paginate':  jQuery('#paginate-quantity-search').val(),
                //'orderBy':  jQuery('#order-by-search').val(),*/
                //'filterWord': jQuery('#search-again').val(), 
                'priceRange': 0, 
                'firstValue': ui.values[0], 
                'secondValue': ui.values[1] 
             }
            $.ajax({
                type: 'GET',
                url: jQuery('#search').attr('href'), 
                data: dataSearch,
                dataType: "JSON", 
                success: function(response) {
                    jQuery('#result-section-search').html('');
                    if(response.success == true){
                        jQuery('#result-section-search').html(response.view);
                        linksPaginator()
                    }
                }
            });
        }
    });

    jQuery("#priceRange").val( "$" + jQuery( "#slider-range-price" ).slider( "values", 0 ) +
    " - $" + jQuery( "#slider-range-price" ).slider( "values", 1 ) );


    jQuery("#slider-range-price-points").slider({
        range: true,
        min: 0,
        max: 9999,
        values: [1, 9999],
        slide: function(event, ui) {
            jQuery("#price-points").val("$" + ui.values[0] + " - $" + ui.values[1]);
        },
        change: function(event, ui) {
            // when the user change the slider
        },
        stop: function(event, ui) {
            // when the user stopped changing the slider
            var firstValue = ui.values[0];
            var secondValue = ui.values[1];
            //alert('First: '+firstValue);
            //$.POST("to.php",{first_value:ui.values[0], second_value:ui.values[1]},function(data){},'json');
            /*$.ajax({
                type: 'GET',
                url: jQuery('#search').attr('href'),
                data: { 'firstValue': ui.values[0], 'secondValue':ui.values[1] },
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                }
            });*/
        }
    });
    jQuery("#price-points").val("$" + jQuery("#slider-range-price-points").slider("values", 0) +
        " - $" + jQuery("#slider-range-price-points").slider("values", 1));
}

var searchAgain = function () {
    jQuery('#search-data').click(function(){
        var url = jQuery('#search').attr('href');
        //console.log(url);
        jQuery.ajax({
            type: 'GET',
            url: url,
            data: {
                /*'categories': jQuery('#categories').val() ? jQuery('#categories').val() : [], 
                'conditionsProducts':  jQuery('#conditionsProducts').val(),
                'conditionsClassifieds':  jQuery('#conditionsClassifieds').val(),
                'classifiedType':  jQuery('#classifiedType').val(),*/
                //'cityId':  jQuery('#cityId').val(),
                'operator':  jQuery('#operator').val(),
                'price':  jQuery('#price').val(),
                'paginate':  jQuery('#paginate-quantity-search').val(),
                //'orderBy':  jQuery('#order-by-search').val(),
                //'filterWord': jQuery('#search-again').val(),
                //'check': $('input[name="select-search[]"]').serializeArray()
            },
            dataType:'json',
            success: function(response) {
                jQuery('#products-list').html('');
                jQuery('#classifieds-list').html('');
                console.log(response);
               if(response.products){
                    loadPaginatorProducts(response);
                    loadDataProducts(response);
                    loadPopUpProducts(response)
                } 
                if(response.classifieds){
                    loadDataClassifieds(response);
                }
            }
        });
        return false;
    });
}

$(window).on('hashchange',function(){
    page = wi
    ndow.location.hash.replace('#','');
    getProducts(page);
});


var linksPaginator = function() {
    $(document).on('click','.pagination a', function(e){
       e.preventDefault();
       var page = $(this).attr('href').split('page=')[1];
       getDataForPage(page);
   });
}

function getDataForPage(page){
    $.ajax({
        type: 'GET',
        url: jQuery('#search').attr('href') +'?page='+ page,
        data: dataSearch,
        dataType:'json',
        success: function(response) {
            console.log(dataSearch);
            jQuery('#result-section-search').html(response.view);
        },
        error: function(objeto, quepaso, otroobj){
            console.log("Error al hacer la petición");
        }
    })
}

var hideFields = function() {
    jQuery('#conditionProduct').hide();
    jQuery('#conditionClassified').hide();
    jQuery('#type').hide();
}

var loadFieldsProduct = function() {
     jQuery('#product').click(function() {
         jQuery('#conditionProduct').toggle();
     });
}

var loadFieldsClassified = function() {
    jQuery('#classified').click(function() {
        jQuery('#conditionClassified').toggle();
        jQuery('#type').toggle();
     });
}


var loadFieldSelect = function(url,idField) {
    $.ajax({
        type: 'GET',
        url: url,
        dataType:'json',
        success: function(response) {
            //console.log(response);
            if (response.success == true) {
                jQuery(idField).html('');
                jQuery(idField).append('<option value=\"\"></option>');
                $.each(response.data,function (k,v){
                    jQuery(idField).append('<option value=\"'+k+'\">'+v+'</option>');
                    $('.chosen-select').trigger("chosen:updated");
                });
            }else{
                jQuery(idField).html('');
                jQuery(idField).append('<option value=\"\"></option>');
            }
        }
    });
}

var loadStatesForCountry = function() {
    $('#countryId').click(function() {
        var url = jQuery('#search-data-for-states').attr('href');
        $.ajax({
            type: 'GET',
            url: url, 
            data: {'countryId': $('#countryId').val()},
            dataType: "JSON",
            success: function(response) {
                /*console.log(response.success);
                console.log(response.states);*/
                if (response.success == true) {
                    $('#stateId').html('');
                    $('#stateId').append('<option value=\"\">  </option>');
                    $.each(response.location,function (k,v){
                        $('#stateId').append('<option value=\"'+k+'\">'+v+'</option>');
                    });
                }else{
                    $('#stateId').html('');
                    $('#stateId').append('<option value=\"\">  </option>');
                }
            }
        });
    });
} 


var loadCitiesForStates = function() {
    $('#stateId').click(function() {
        var url = jQuery('#search-data-for-cities').attr('href');
        $.ajax({
            type: 'GET',
            url: url, 
            data: {'stateId': $('#stateId').val()},
            dataType: "JSON",
            success: function(response) {
                /*console.log(response.success);
                console.log(response.states);*/
                if (response.success == true) {
                    $('#cityId').html('');
                    $('#cityId').append('<option value=\"\">  </option>');
                    $.each(response.location,function (k,v){
                        $('#cityId').append('<option value=\"'+k+'\">'+v+'</option>');
                    });
                }else{
                    $('#cityId').html('');
                    $('#cityId').append('<option value=\"\">  </option>');
                }
            }
        });
    });
} 


/*
 * --------------- Custom scripts for bussiness logic ----------------
 */

/*
 * --------------------- Wishlist Logic ----------------------
 */

var addToWishlist = function() {
    jQuery('.add_wishlist').click(function() {
        var url = jQuery(this).attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    if (response.success) {
                        var wishlist = jQuery('#products-wishlist');
                        var product = response.product;
                        var template = jQuery('#wishlist-tpl').html();
                        var html = Mustache.to_html(template, product);
                        wishlist.prepend(html);
                        addCountToWishlist();
                    } else {
                        alert('No se pudo agregar el producto!');
                    }
                } else {

                }
            }
        });
        return false;
    });
}

var removeFromWishList = function() {
    jQuery(document).on('click', '.delete-from-wishlist', function() {
        var element = jQuery(this);
        var url = element.attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    if (response.success) {
                        element.closest('.li').remove();
                        discountFromWishlist();
                    } else {
                        alert('No se pudo eliminar el producto!');
                    }
                } else {

                }
            }
        });
        return false;
    });

    jQuery(document).on('click', '.delete-from-wishlist-list', function() {
        var element = jQuery(this);
        var url = element.attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    if (response.success) {
                        element.closest('tr').remove();
                        discountFromWishlist();
                    } else {
                        alert('No se pudo eliminar el producto!');
                    }
                } else {

                }
            }
        });
        return false;
    });
}

var addCountToWishlist = function() {
    var wishlistCount = parseInt(jQuery('#wishlist-count').html());
    if (isNaN(wishlistCount)) wishlistCount = 0;
    jQuery('#wishlist-count').html(wishlistCount + 1);
}

var discountFromWishlist = function() {
    var wishlistCount = parseInt(jQuery('#wishlist-count').html());
    if (isNaN(wishlistCount)) wishlistCount = 0;
    if (wishlistCount > 0)
        wishlistCount--;
    jQuery('#wishlist-count').html(wishlistCount);
}


/*
 * --------------------- End Wishlist Logic ----------------------
 */
/*
 * --------------------- Shopping Cart Logic ----------------------
 */
var addToCart = function() {
    jQuery('.add_cart').click(function() {
        var url = jQuery(this).attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    if (response.success) {
                        var cart = jQuery('#products-cart');
                        var product = response.product;
                        var template = jQuery('#cart-tpl').html();
                        var html = Mustache.to_html(template, product);
                        cart.prepend(html);
                        addCountTocart();
                    } else {
                        alert('No se pudo agregar el producto!');
                    }
                } else {

                }
            }
        });
        return false;
    });
}

var removeFromCart = function() {
    jQuery(document).on('click', '.delete-from-cart', function() {
        var element = jQuery(this);
        var url = element.attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    if (response.success) {
                        element.closest('.li').remove();
                        discountFromcart();
                    } else {
                        alert('No se pudo eliminar el producto!');
                    }
                } else {

                }
            }
        });
        return false;
    });

    jQuery(document).on('click', '.delete-from-cart-list', function() {
        var element = jQuery(this);
        var url = element.attr('href');
        jQuery.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    if (response.success) {
                        element.closest('tr').remove();
                        discountFromcart();
                        jQuery('#sub-total').text(response.total);
                        jQuery('#total').text(response.total);
                    } else {
                        alert('No se pudo eliminar el producto!');
                    }
                } else {

                }
            }
        });
        return false;
    });
}

var addCountTocart = function() {
    var cartCount = parseInt(jQuery('#cart-count').html());
    if (isNaN(cartCount)) cartCount = 0;
    jQuery('#cart-count').html(cartCount + 1);
}

var discountFromcart = function() {
        var cartCount = parseInt(jQuery('#cart-count').html());
        if (isNaN(cartCount)) cartCount = 0;
        if (cartCount > 0)
            cartCount--;
        jQuery('#cart-count').html(cartCount);
    }
/*
 * ---------------------End Shopping Cart Logic ----------------------
 */

/*
 * --------------------- Rating Logic ----------------------
 */
var rating = function() {    
    jQuery("#rating").bind('rated', function(event, value) {
        alert('You\'ve rated it: ' + value);
    });
}
/*
 * --------------------- End Rating Logic ----------------------
 */


jQuery(document).ready(function() {
    // Init de plugins --------------------------
    handleFancybox();
    initImageZoom();
    initTouchspin();
    initSliderRange();

    // Init bussiness logic-----------------------
    addToWishlist();
    removeFromWishList();
    addToCart();
    removeFromCart();
    rating();
    //searchAgain();
    loadFieldsProduct();
    loadFieldsClassified();

    hideFields();

    loadFieldSelect(jQuery('#search-data-conditions-product-lang').attr('href'), '#conditionsProducts');
    loadFieldSelect(jQuery('#search-data-conditions-classified-lang').attr('href'), '#conditionsClassifieds');
    loadFieldSelect(jQuery('#search-data-classified-type-lang').attr('href'), '#classifiedType');

    //load countries
    loadFieldSelect(jQuery('#search-data-for-country').attr('href'), '#countryId');
    loadStatesForCountry();
    loadCitiesForStates();
});

