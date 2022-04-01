$('.show-alert-delete-box').click(function(event){
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    return swal({
        title: `Are you sure you want to delete this ${name}?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: ["Cancel","Yes!"],
        confirmButtonClass: "btn-danger",
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});
