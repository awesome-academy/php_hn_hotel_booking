$(document).ready(function () {
    let translator = new I18n;

    $('.detail-order').click(function () {
        var html = "";
        $.ajax({
            method: "GET",
            url: "/partners/orders/detail/",
            data: {
                id: $(this).data("id")
            },
            success: function (data) {
                $('#detailOrder .card').html("");
                var data = JSON.parse(data);
                for(var i = 0; i < data.length; i++) {
                    let html =
                        `<div class="card-header">
                                <h3 class="card-title">${ translator.trans('customer.room')}${ (i+1) }</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item active">
                                        <a href="#" class="nav-link">${ translator.trans('customer.types_room')}
                                            <span class="badge bg-primary float-right">${ data[i].room_id }</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">${ translator.trans('customer.qty')}
                                            <span class="badge bg-primary float-right">${ data[i].qty }</span> </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">${ translator.trans('customer.price')}
                                            <span class="badge bg-primary float-right">${  data[i].price }</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>`
                    $('#detailOrder .card').append(html);
                }
            }
        })
    })
})
