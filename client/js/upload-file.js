// $('#myForm').on('file_upload', function (e) {
//   $('#myModal').modal('show');
//   e.stopPropagation();
// });

$("#myForm").on('file_upload', function (e) {
  e.stopPropagation();
  $.ajax({
    type: 'POST',
    data: $("#file").serialize(),
    url: "../dashboard.php",
    success: function (data) {
      window.location = window.location.href + "?openmodal=1"
      $('#myModal').modal('show');
    }
  });
  return false;
});