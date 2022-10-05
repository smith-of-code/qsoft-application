$(function() {
    $(document).on("submit", "#user_info", function (e) {
        e.preventDefault();
        let $form = $("#user_info");
        let arFormData = $form.serializeArray();

        $.ajax({
            url: "",
            method: "post",
            data: arFormData,
            success: function () {
                window.location = "/personal/";
            }
        });
    });
});