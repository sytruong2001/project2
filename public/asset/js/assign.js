load_data();

function load_data() {
    $.ajax({
        url: "/assign/showInfo",
        type: "get",
        dataType: "json",
        success: function (data) {
            console.log(data);
            debugger;
        },
    });
}
$("#idClass").on("change", function () {
    var idClass = $(this).val();
    $.ajax({
        url: "/assign/create",
        type: "get",
        data: {
            idClass: idClass,
        },
        success: function (data) {
            console.log(1);
        },
    });
});
