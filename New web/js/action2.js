function confirmation1() {
  var msg;

  var r = confirm("Are you sure you want to BANNED this account!");
  if (r == true) {
    msg="confirmed";
    $.ajax({
       url:'http://localhost/TrainTrackingSystem/New%20web/Adminaction.php',
       method:"POST",
       data:{msg:msg},
     });
  } else {
    msg = "Canceled!";
  }


  document.getElementById("demo").innerHTML = msg;
}

function confirmation2() {
  var msg;

  var r = confirm("Are you sure you want to ACTIVE this account!");
  if (r == true) {
    msg="Activated";
    $.ajax({
      url:'http://localhost/TrainTrackingSystem/New%20web/Adminaction.php',
      method:"POST",
      data:{msg:msg},
    });
  } else {
    msg = "Canceled!";
  }

  document.getElementById("demo").innerHTML = msg;
}
