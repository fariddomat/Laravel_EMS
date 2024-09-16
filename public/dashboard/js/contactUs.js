$(document).ready(function () {
  $("#contactsTable tbody").on("click", ".change-status", function (event) {
    var that = $(this);
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
    event.preventDefault();
    var notyObject = new Noty({
      text: "Confirm Change Status",
      type: "warning",
      killer: true,
      buttons: [
        Noty.button("Yes", "btn btn-success me-2", function () {
          notyObject.close();
          that.prop("disabled", true);
          $.ajax({
            url: that.data("link"),
            type: "POST",
            data: { _token: CSRF_TOKEN },
            dataType: "JSON",
            success: function (data) {
              that.replaceWith('<span class="text-success">Done</span>');
              alert(data.message);
            },
          });
        }),

        Noty.button("No", "btn btn-primary me-2", function () {
          notyObject.close();
        }),
      ],
    });

    notyObject.show();
  });
});
