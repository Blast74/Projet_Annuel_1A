function followUser(email, input){
  var state = getFollowVal(email);
  console.log(state);
  var newState = Number(!(state));
  console.log(newState);
  var sessionId = getCookie('access');
  var request = new XMLHttpRequest;
  request.onreadystatechange = (function(){
    if (request.readyState == 4){
      if (request.status == 200 ){
        console.log(request.responseText);

      }
    }
  });
  request.open("POST", "addLike.php");
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded",0);
  var params = [
    `sessionId=${sessionId[1]}`,
    `follow=${email}`,
    `value=${newState}`
  ];
  console.log(params.join("&"));
  request.send(params.join("&"));
  if(request.responseText == 0){
    input.value = "Suivre";
  }else {
    input.value = "Ne plus suivre";
  }
}

function getFollowVal(email){
  var sessionId = getCookie('access');
  console.log(sessionId);
  var request = new XMLHttpRequest;
  var result ;
  request.onreadystatechange = (function(){
    if (request.readyState == 4){
      if (request.status != 200){
        result = 0;
      }else {
        result = Number(request.responseText);
      }
    }
  });
    var params = [
      `sessionId=${sessionId[1]}`,
      `email=${email}`
    ];
  request.open("GET", `getFollower.php?${params.join("&")}`, 0);
  request.send();
  console.log(Number(request.responseText));
  return(result);
}
