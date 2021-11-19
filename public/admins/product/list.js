
$(document).ready(function () {

    $("body").on("click","#deleteProduct",function(e){
         alert();


        e.preventDefault();


        $.ajax(
            {
                url: url.href, //or you can use url: "company/"+id,
                type: 'DELETE',
                data: {
                    _token: token,
                    id: id
                },
                success: function (response){

                    $("#success").html(response.message)

                    Swal.fire(
                        'Remind!',
                        'Company deleted successfully!',
                        'success'
                    )
                }
            });
        return false;
    });


});

