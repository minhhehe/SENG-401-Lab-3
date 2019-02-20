$(document).ready(function() {

  $("#task11Button").on("click", function(e) {
    e.preventDefault();
    var school_text = $('#task5Value').serialize();
    var type_selected = $('#typeListID option:selected').text();
    $.ajax({
        url: 'http://localhost:80/server/task11.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: school_text,
        type: 'POST',
        success: function(php_script_response){
          $('#resultSpace11').html(php_script_response);
        }
     });
     return false;
  });

});
