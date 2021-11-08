$('#myForm').on('file', function (e) {
  $('#myModal').modal('show');
  e.preventDefault();
});