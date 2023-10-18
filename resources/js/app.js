import './bootstrap';

$(document).ready(function () {
    $(".modal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);

        modal.find(".modal-title").text(button.data("title"));
    });
});
