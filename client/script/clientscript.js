$(document).ready(function() {

  $("#task11Button").on("click", function(e) {
    var urlToUse;
    if ($("#MySQLRadio").is(":checked")) {
      urlToUse = "http://localhost:80/server/task11PDO.php";
    } else if ($("#PostgreSQLRadio").is(":checked")) {
      urlToUse = "http://localhost:80/server/task11PDO.php";
    }
    e.preventDefault();
    var school_text = $('#task1Value').val();
    var type_selected = $('#typeListID1 option:selected').text();
    $.ajax({
      url: urlToUse, // point to server-side PHP script
      //dataType: 'text',  // what to expect back from the PHP script, if anything
      data: {
        school_data: school_text,
        type_data: type_selected,
        username: $('#username').val(),
        password: $('#password').val()
      },
      type: 'post',
      success: function(php_script_response){
        $('#resultSpace11').empty();
        $('#resultSpace11').html(php_script_response);
      }
     });
     return false;
  });

  $("#task12Button").on("click", function(e) {
    var urlToUse;
    if ($("#MySQLRadio").is(":checked")) {
      urlToUse = "http://localhost:80/server/task11PDO.php";
    } else if ($("#PostgreSQLRadio").is(":checked")) {
      urlToUse = "http://localhost:80/server/task11PDO.php";
    }
    e.preventDefault();
    var section_selected = $('#sectionListID option:selected').text();
    var type_selected = $('#typeListID2 option:selected').text();
    $.ajax({
      url: urlToUse, // point to server-side PHP script
      //dataType: 'text',  // what to expect back from the PHP script, if anything
      data: {
        section_data: section_selected,
        type_data: type_selected,
        username: $('#username').val(),
        password: $('#password').val()
      },
      type: 'post',
      success: function(php_script_response){
        $('#resultSpace12').empty();
        $('#resultSpace12').html(php_script_response);
      }
     });
     return false;
  });

});
