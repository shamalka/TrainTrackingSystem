function confirmation1() {
  var msg;
  var r = confirm("Are you sure you want to BANNED this account!");
  if (r == true) {
    msg="confirmed";
    document.cookie="message=Banned";
    location.reload();
}
  else {
    msg = "Canceled!";
    document.cookie="message=Cancelled";
    location.reload();
  }

}

function confirmation2() {
  var msg;

  var r = confirm("Are you sure you want to ACTIVE this account!");
  if (r == true) {
    msg="Activated";
    document.cookie="message=Activated";
    location.reload();
  }
  else {
    msg = "Canceled!";
    document.cookie="message=Cancelled";
    location.reload();
  }

}

function cf(id){
  var id=id;
  document.cookie = 'nic='+id+'';
}
function refresh(){
        childWindow.location.href="http://localhost/TrainTrackingSystem/New%20web/AdminUser.php";
    }
