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
        window.location.reload();
    }
//setInterval('refresh()', 30000);

function verify(id){
    var ver=id;
    var r= confirm("Are you sure you want to VERIFY this post");
    if(r==true){
      document.cookie='verify='+ver+'';
      location.reload();
    }
    else{
      alert("Cancelled");
    }
}

function deleterow(id){
    var der=id;
    var r= confirm("Are you sure you want to DELETE this post");
    if(r==true){
      document.cookie='delete='+der+'';
      location.reload();
    }
    else{
      alert("Cancelled");
    }
}

function deleterow2(id){
    var der=id;
    var r= confirm("Are you sure you want to DELETE this RESERVATION");
    if(r==true){
      document.cookie='delete='+der+'';
      location.reload();
    }
    else{
      alert("Cancelled");
    }
}
function cf2(id){
  var id=id;
  document.cookie = 'trainid='+id+'';
}
