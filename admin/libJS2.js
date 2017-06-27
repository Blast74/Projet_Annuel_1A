//Taableau de tous les cookies (O => nom, 1 => valeurs)
function getCookies(){
  var cookies = document.cookie.split(";");
  var result = [];
  cookies.forEach(function(cookie){
    result.push(cookie.split("="));
  });
  return result;
}

//trouve le cookie qui correspond au nom
function getCookie(name){
  var cookies = getCookies();
  var result;
  cookies.forEach(function(cookie){
      if (cookie[0] == name){
        result = cookie;
      }
    }
  );
  if (result != null) {
    return result;
  }else {
    return null;
  }
}

function changeInnerHTML(newValues, idTag){
  var tag = document.getElementById(idTag);
  for(var i = 0; i < newValues.length; i++){
    tag.childNodes[i].innerHTML = newValues[i];
    console.log(tag.childNodes[i]);
  }
}
function modifUserInfo(tr, email){
  console.log(tr.childNodes);
  console.log(email);
  changeToForm(tr);
}
function changeToForm(tr){
  tr.childNodes.forEach(function(td){
    console.log(td.headers);
    var old = td.innerHTMl;


  });
}

function editRight(right, emailUser){
  var access = getCookie("access");
  var ajaxRequest = new XMLHttpRequest;
  console.log(access);
  ajaxRequest.onreadystatechange = (function(){
    if (ajaxRequest.readyState == 4){
      if (ajaxRequest.status == 200){
        var tableUsers = ajaxRequest.responseText;
        console.log(ajaxRequest.responseText);
        var result = document.getElementById('resultRightOperation');
        var op = document.createElement('li');
        op.innerHTML = ajaxRequest.responseText;
        result.appendChild(op);
      }
    }
  });
  var param = [`option=${right}`, `user_email=${emailUser}`, `access_token=${access[1]}`];
  param = param.join("&");
  ajaxRequest.open("POST", `admin/rightUsers.php`, 0);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(param);
  listHtmlUsers('listUsers');
}
