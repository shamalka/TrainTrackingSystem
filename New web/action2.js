function confirmation1() {
  var msg;
  var r = confirm("Are you sure you want to BANNED this account!");
  if (r == true) {
    msg="confirmed";
    document.cookie="message=Banned";
    location.reload();
  /*  $(document).ready(function(){
      $("button").click(function(){
    $.ajax({
       url:'http://localhost/TrainTrackingSystem/New%20web/Adminaction.php',
       method:"POST",
       data:{msg:msg},
     });
   });
 });*/
  }
  else {
    msg = "Canceled!";
    document.cookie="message=Cancelled";
    location.reload();
  }


  document.getElementById("message").innerHTML = msg;
}

function confirmation2() {
  var msg;

  var r = confirm("Are you sure you want to ACTIVE this account!");
  if (r == true) {
    msg="Activated";
    document.cookie="message=Activated";
    location.reload();
  /*  $(document).ready(function(){
      $("button").click(function(){
    $.ajax({
      url:'http://localhost/TrainTrackingSystem/New%20web/Adminaction.php',
      method:"POST",
      data:{msg:msg},
    });
  });
});*/
  } else {
    msg = "Canceled!";
    document.cookie="message=Cancelled";
    location.reload();
  }

  document.getElementById("message").innerHTML = msg;
}
