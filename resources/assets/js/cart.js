$(document).ready(function () {
    let translator = new I18n;

    $(document).on("click", ".add-cart", function (event) {
        var hotelId = $(this).data('hotelid');
        var roomId = $(this).data('roomid');
        $.ajax({
            method: "GET",
            url: "/booking/add-to-cart",
            data: {
                roomId: roomId,
                hotelId: hotelId,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if(Object.keys(data).length > 0) {
                    let html =
                        `<div class="padding20">
                            <span class="opensans size18 dark bold caps">${ data.carts.hotelName }</span>
                        </div>
                        <div class="line3"></div>
                        <div class="hpadding30 margtop30">
                            <span class="dark size16 bold avg_night">${ data.carts.avg_night } ${ translator.trans('customer.days')}</span><br>
                            <span class="grey size13 bold checkIn">${ translator.trans('customer.check_in_date')}: ${ data.carts.checkIn } </span><br>
                            <span class="grey size13 bold checkOut">${ translator.trans('customer.check_out_date')}: ${ data.carts.checkOut } </span><br>
                            <div class="fdash mt10"></div>
                            <br>
                            <span class="grey size13">${ translator.trans('customer.price')}:</span>
                            <span class="size16 bold lred2 right total">$${ data.total }</span>
                            <div class="clearfix"></div>
                            <div class="fdash mt10"></div>
                            <br>
                            <span class="dark size16 bold">${ translator.trans('customer.guests')}</span><br>
                            <span class="size12 grey2 bold">
                            <div class="clearfix"></div>
                                # ${ translator.trans('customer.staterooms')}: <span class="right room_in_cart">${ Object.keys(data.carts[hotelId]).length }</span>
                            <div class="clearfix"></div>
                            </span>
                            <br>
                        </div>
                        `;
                    $('#mycart .pagecontainer2.grey').html(html);
                    var i = 0;
                    for (var key in  data.carts[hotelId]) {
                        i++;
                        let cart =
                            `<div id="cart${ key }" class="hpadding30 margtop30">
                                <div class="d-flex">
                                    <div class="dark size16 bold w-50">Stateroom ${ i }:</div>
                                    <div class="edit-cart w-50">
                                        <button class="add-cart" data-hotelid="${ hotelId }" data-roomid="${ key }" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        <button class="sub-cart" data-hotelid="${ hotelId }" data-roomid="${ key }"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                        <button class="remove-cart" data-hotelid="${ hotelId }" data-roomid="${ key }"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <div class="fdash mt10"></div>
                                <br>
                                <table class="wh100percent size13">
                                    <tbody>
                                        <tr>
                                            <td valign="top">${ translator.trans('customer.staterooms')}:</td>
                                            <td class="textright">${ data.carts[hotelId][key]['name'] }</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">${ translator.trans('customer.qty')}:</td>
                                            <td class="textright qty">${ data.carts[hotelId][key]['qty'] }</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">${ translator.trans('customer.price')}:</td>
                                            <td class="textright">$${ data.carts[hotelId][key]['price'] }</td>
                                        </tr>
                                        <tr>
                                            <td valign="top">${ translator.trans('customer.avg_night')}:</td>
                                            <td class="textright">${ data.carts.avg_night }</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="fdash mt10"></div>
                                                <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" class="dark bold">${ translator.trans('customer.subtotal')}*</td>
                                            <td class="textright dark bold subtotal">$${ data.carts[hotelId][key]['qty'] * data.carts[hotelId][key]['price'] * data.carts.avg_night }</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        `;
                        $('#mycart .pagecontainer2.grey').append(cart);
                    }
                    let checkout = `
                        <div class="hpadding20">
                            <a href="/booking/checkout/${hotelId}" class="booknow margtop20 btnmarg">Checkout</a>
                        </div>
                        `;
                    $('#mycart .pagecontainer2.grey').append(checkout);

                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    })
                } else {
                    $('#mycart .pagecontainer2.grey').html("");
                }
            }
        })
    })

    $(document).on('click', ".sub-cart", function () {
        var hotelId = $(this).data('hotelid');
        var roomId = $(this).data('roomid');
        $.ajax({
            method: "GET",
            url: "/booking/sub-room",
            data: {
                roomId: roomId,
                hotelId: hotelId,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (Object.keys(data.carts[hotelId]).length > 0) {
                    if(typeof data.carts[hotelId][roomId] != 'undefined') {
                        var qty = data.carts[hotelId][roomId]['qty'];
                        $('#cart' + roomId + ' .qty').html(qty);
                        $('#cart' + roomId + ' .avg_night').html(data.carts.avg_night);
                        $('#cart' +' .total').html(data.total);
                        $('#cart' + roomId + ' .subtotal').html('$'+ data.carts[hotelId][roomId]['qty'] * data.carts[hotelId][roomId]['price']);

                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        })
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        })
                        $('#cart' + roomId).html('');
                        $('#mycart .room_in_cart').html(Object.keys(data.carts[hotelId]).length);
                    }
                } else {
                    $('#mycart .pagecontainer2.grey').html("");
                }
            }
        })
    })
    $(document).on('click', ".remove-cart", function () {
        var hotelId = $(this).data('hotelid');
        var roomId = $(this).data('roomid');
        $.ajax({
            method: "GET",
            url: "/booking/remove-room",
            data: {
                roomId: roomId,
                hotelId: hotelId,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (Object.keys(data.carts[hotelId]).length > 0) {
                    $('#cart' + roomId).html('');
                    $('#mycart .room_in_cart').html(Object.keys(data.carts[hotelId]).length);

                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    })
                } else {
                    $('#mycart .pagecontainer2.grey').html("");
                }
            }
        })
    })
})
