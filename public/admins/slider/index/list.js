//
// $(document).ready(function () {
//
//     $("body").on("click","#deleteCompany",function(e){
//
//         if(!confirm("Do you really want to do this?")) {
//             return false;
//         }
//
//         e.preventDefault();
//         var id = $(this).data("id");
//         // var id = $(this).attr('data-id');
//         var token = $("meta[name='csrf-token']").attr("content");
//         var url = e.target;
//
//         $.ajax(
//             {
//                 url: url.href, //or you can use url: "company/"+id,
//                 type: 'DELETE',
//                 data: {
//                     _token: token,
//                     id: id
//                 },
//                 success: function (response){
//
//                     $("#success").html(response.message)
//
//                     Swal.fire(
//                         'Remind!',
//                         'Company deleted successfully!',
//                         'success'
//                     )
//                 }
//             });
//         return false;
//     });
//
//
// });
// $("#delete_slider").onclick(function (e) {
//     e.preventDefault();
//
//     let id = $(this).data("id");
//     // var id = $(this).attr('data-id');
//     let token = $("meta[name='csrf-token']").attr("content");
//     let url = e.target;
//     let that = $(this);
//
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!'
//     }).then((result) => {
//         if (result.value) {
//
//             $.ajax(
//                 {
//                     url: url.href, //or you can use url: "company/"+id,
//                     type: 'GET',
//                     data: {
//                         _token: token,
//                         id: id
//                     },
//                     success: function (data) {
//                         if (data.code == 200) {
//                             that.parent().parent().remove();
//                         }
//
//                     },
//                     error: function () {
//
//                     }
//                 });
//
//         }
//     });
//     return false;
// });
//
