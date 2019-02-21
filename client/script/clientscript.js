$(document).ready(function() {

  $('#flickrInputButtonID').prop("disabled", true);

  $("#task11Button").on("click", function(e) {
    var urlToUse;
    if ($("#MySQLRadio").is(":checked")) {
      urlToUse = "http://localhost:80/server/task11MySQL.php";
    } else if ($("#PostgreSQLRadio").is(":checked")) {
      urlToUse = "http://localhost:80/server/task11PDO.php";
    }
    e.preventDefault();
    var school_text = $('#task1Value').val();
    var type_selected = $('#typeListID1 option:selected').text();
    $.ajax({
      url: urlToUse, // point to server-side PHP script
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
      urlToUse = "http://localhost:80/server/task12MySQL.php";
    } else if ($("#PostgreSQLRadio").is(":checked")) {
      urlToUse = "http://localhost:80/server/task12PDO.php";
    }
    e.preventDefault();
    var section_selected = $('#sectionListID option:selected').text();
    var type_selected = $('#typeListID2 option:selected').text();
    $.ajax({
      url: urlToUse, // point to server-side PHP script
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

function checkValidityOfForm(input) {
  var listOfInputs = input.split(",");
  if (!checkNumberOfInput(listOfInputs)) return;
  var firstNumber = parseFloat(listOfInputs[0]);
  var secondNumber = parseFloat(listOfInputs[1]);
  var thirdNumber = parseFloat(listOfInputs[2]);
  var fourthNumber = parseFloat(listOfInputs[3]);
  if (!checkIfValidInputFloat(firstNumber, secondNumber, thirdNumber, fourthNumber)) return;
  if (!checkIfValidInputCoordinates(firstNumber, secondNumber, thirdNumber, fourthNumber)) return;
  $('#flickrInputButtonID').prop("disabled", false);
}

function checkIfValidInputCoordinates(long1, lat1, long2, lat2) {
  $('#validityMessageID').empty();
  if ((long1 < -180) || (long1 > 180) || (long2 < -180) || (long2 > 180)) {
    $('#validityMessageID').html("One of the longitudes is not between -180 and 180");
    $('#flickrInputButtonID').prop("disabled", true);
    return false;
  }
  if ((lat1 < -90) || (lat1 > 90) || (lat2 < -90) || (lat2 > 90)) {
    $('#validityMessageID').html("One of the latitudes is not between -90 and 90");
    $('#flickrInputButtonID').prop("disabled", true);
    return false;
  }
  if ((long1 > long2)) {
    $('#validityMessageID').html("Left value's longitude should be smaller than right value's");
    $('#flickrInputButtonID').prop("disabled", true);
    return false;
  }
  if ((lat1 < lat2)) {
    $('#validityMessageID').html("Left value's latitude should be smaller than right value's");
    $('#flickrInputButtonID').prop("disabled", true);
    return false;
  }
  return true;
}

function checkIfValidInputFloat(firstNumber, secondNumber, thirdNumber, fourthNumber) {
  $('#validityMessageID').empty();
  if (Number.isNaN(firstNumber) || Number.isNaN(secondNumber) || Number.isNaN(thirdNumber)
      || Number.isNaN(fourthNumber)) {
    $('#validityMessageID').html("One of the values is not a number");
    $('#flickrInputButtonID').prop("disabled", true);
    return false;
  }
  $('#flickrInputButtonID').prop("disabled", false);
  return true;
}

function checkNumberOfInput(listOfInputs) {5
  var numOfInput = listOfInputs.length;
  $('#validityMessageID').empty();
  if (numOfInput < 4) {
    $('#validityMessageID').html("Not enough inputs");
    $('#flickrInputButtonID').prop("disabled", true);
    return false;
  } else if (numOfInput > 4) {
    $('#validityMessageID').html("Too many inputs");
    $('#flickrInputButtonID').prop("disabled", true);
    return false;
  } else {
    $('#flickrInputButtonID').prop("disabled", false);
    return true;
  }
}
