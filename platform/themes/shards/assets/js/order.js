import toastr from "toastr";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
        $("#loading").css("display", "flex");
    },
    complete: function () {
        $("#loading").css("display", "none");
    }
});
$(document).ready(function () {

    $("#cart-form").submit(function () {
        $(".loading-order").css('display','flex');
    });

    $("#Country").change(function () {
        $("#province")
            .find("option")
            .remove()
            .end()
            .append('<option value="">-- Province -- </option>');
        var Country = $(this).children("option:selected").val();
        $.ajax({
            url: '/getStates',
            type: 'POST',
            data: {
                idCountry: Country
            },
            success: function (response) {
                var obj = JSON.parse(response);
                $.each(obj, function (index, value) {
                    $("#province").append("<option value=" + value.id + ">" + value.name + "</option>");
                });
            },
            error: function (response) {
                console.log(response.message);
            }
        });
    });
    $("#province").change(function () {
        $("#District")
            .find("option")
            .remove()
            .end()
            .append('<option value="">-- District -- </option>');
        var province = $(this).children("option:selected").val();
        $.ajax({
            url: '/getDistrict',
            type: 'POST',
            data: {
                idProvice: province
            },
            success: function (response) {
                $.each(response, function (index, value) {
                    $("#District").append("<option value='" + value.id + "'>" + value.name + "</option>");
                });
            },
            error: function (response) {
                console.log(response.message);
            }
        });
    });

    function formatMoney(number, decPlaces, decSep, thouSep) {
        (decPlaces = isNaN((decPlaces = Math.abs(decPlaces))) ? 2 : decPlaces),
            (decSep = typeof decSep === "undefined" ? "." : decSep);
        thouSep = typeof thouSep === "undefined" ? "." : thouSep;
        var sign = number < 0 ? "-" : "";
        var i = String(
            parseInt(
                (number = Math.abs(Number(number) || 0).toFixed(decPlaces))
            )
        );
        var j = (j = i.length) > 3 ? j % 3 : 0;

        return (
            sign +
            (j ? i.substr(0, j) + thouSep : "") +
            i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
            (decPlaces
                ? decSep +
                Math.abs(number - i)
                    .toFixed(decPlaces)
                    .slice(2)
                : "")
        );
    }

    $(".decrease").click(function () {
        var value = parseInt(
            $(this)
                .parent()
                .find("input.qty")
                .val()
        );
        var price = parseFloat($("#price").text());
        value = isNaN(value) ? 0 : value;
        value--;
        value < 1 ? (value = 1) : value;
        $(this)
            .parent()
            .find("input.qty")
            .val(value);
        var formatTotal = formatMoney(Number(price) * Number(value));
        $("#total").text(formatTotal + "$");
    });

    $(".increase").click(function () {
        var value = parseInt(
            $(this)
                .parent()
                .find("input.qty")
                .val()
        );
        var price = parseFloat($("#price").text());
        value = isNaN(value) ? 1 : value;
        value++;

        $(this)
            .parent()
            .find("input.qty")
            .val(value);
        var formatTotal = formatMoney(Number(price) * Number(value));
        $("#total").text(formatTotal + "VND");
    });

    $("#add-to-cart").click(function () {
        // localStorage.numberCart = Number(localStorage.numberCart) + 1;
        var id = $(this).attr("product_id");
        var qty = parseInt($("input#qty").val());
        var $this = $(this);
        $this.attr("disabled", true);
        $.ajax({
            url: "/add-to-cart",
            type: "POST",
            data: {
                id: id,
                qty: qty
            },
            success: function (response) {
                var obj = JSON.parse(response);
                $("#itemCart").text(obj.numberCart);
                toastr.success(obj.message);
            },
            error: function (response) {
                toastr.error(response.message);
            }
        }).done(function () {
            $this.removeAttr("disabled");
        });
    });

    $(".action-update-cart").on("click", function () {
        var $this = $(this);
        var input = $(this).parent().find("input.qty");
        var id = input.attr('data-product-id');
        var qty = input.val();
        $(this).attr("disabled", "true");
        $.ajax({
            url: "/update-cart",
            type: "POST",
            data: {
                id: id,
                qty: qty
            },
            success: function (response) {
                var obj = JSON.parse(response);
                console.log(obj.subTotal);
                $('#total-price').text('$ ' + obj.subTotal);
                // if (response.code === 200) {
                //     var data = response.data;
                //     $("#cart-qty").text(data.totalQty);
                //     $("#total-price").text(data.totalPriceFormatted);
                // }
                toastr.success(obj.message);
            },
            error: function (response) {
                toastr.error(response.message);
            }
        }).done(function () {
            $this.removeAttr("disabled");
        });
    });

    $(".cart-delete-item").click(function () {
        var id = $(this)
            .parent()
            .find("input.qty")
            .data("product-id");
        if (id) {
            var $this = $(this);
            $this.attr("disabled", true);
            $.ajax({
                url: "remove-cart-item",
                type: "POST",
                data: {
                    id: id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    $("#total-price").text('$ ' + obj.subTotal);
                    $("#itemCart").text(obj.numberCart);
                    if (obj.subTotalNoFormat == 0) {
                        console.log(obj.subTotalNoFormat);
                        $(".empty").css('display', 'none');
                        $("#message-no-item").text('There are currently no products in the cart!');
                    }
                    $this.closest(".cart-item").remove();
                    toastr.success(obj.message);
                },
                error: function (response) {
                    var obj = JSON.parse(response);
                    toastr.error(obj.message);
                }
            }).done(function () {
                $this.removeAttr("disabled");
            });
        }
    });
});
