//edit user modal
$("body").on("click", ".editBtn", function (event) {
    var modal = $("#editUserModal");
    modal.find("input[name=name]").val($(this).data("name"));
    modal.find("input[name=email]").val($(this).data("email"));
    modal.find("input[name=phone]").val($(this).data("phone"));
    modal.find("input[name=age]").val($(this).data("age"));
    modal.find("input[name=country]").val($(this).data("country"));
    modal.find("form").attr("action", $(this).data("action"));
    modal.modal("show");
});

// delete user modal
$("body").on("click", ".deleteBtn", function (event) {
    var modal = $('#deleteUserModal');
    modal.find("form").attr("action", $(this).data("action"));
    modal.modal('show');
});

