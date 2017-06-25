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
