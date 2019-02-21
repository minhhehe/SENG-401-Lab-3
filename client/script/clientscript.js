$(document).ready(function() {

  $("#task11Button").on("click", function(e) {
    e.preventDefault();
    var school_text = $('#task1Value').val();
    var type_selected = $('#typeListID1 option:selected').text();
    $.ajax({
      url: 'http://localhost:80/server/task11.php', // point to server-side PHP script
      //dataType: 'text',  // what to expect back from the PHP script, if anything
      data: {
        school_data: school_text,
        type_data: type_selected
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
    e.preventDefault();
    var section_selected = $('#sectionListID option:selected').text();
    var type_selected = $('#typeListID2 option:selected').text();
    $.ajax({
      url: 'http://localhost:80/server/task12.php', // point to server-side PHP script
      //dataType: 'text',  // what to expect back from the PHP script, if anything
      data: {
        section_data: section_selected,
        type_data: type_selected
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
