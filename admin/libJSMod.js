
function listUsers(idSession){
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function() {
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
          var container = document.getElementById('userslistAjax');
          var tableUsers = JSON.parse(ajaxRequest.responseText);
          console.log(tableUsers);
      }
  };
  ajaxRequest.open("GET", `admin/testOrder.php?access_token=${idSession}`, true);
  ajaxRequest.send();
}

function getUsersByPages(id){

  var nbUsersByPage = document.getElementById(id);
  return nbUsersByPage.options[nbUsersByPage.selectedIndex].value;

}

function getOrderDisplay(id){

  var orderDisplay = document.getElementById(id);
  return orderDisplay.options[orderDisplay.selectedIndex].value;

}

function getOrderOption(id){

  var orderOption = document.getElementById(id);
  return orderOption.options[orderOption.selectedIndex].value;

}

// function changePageTable(nbPage,str){
//   recupParam(str);
//
//
//
// }
function recupParam(displayDivId){
  var test = document.getElementsByName('userModList');
  var idSession = '<?php echo $_SESSION["id"]; ?>';
  listUsers(idSession);
  console.log(document.getElementById(displayDivId).childNodes.tables);

}

function createElementWithId(idContainer, typeOfElem){

  var container = document.getElementById(idContainer);
  var elem = document.createElement(typeOfElem);
  elem.id = typeOfElem + idContainer.charAt(0).toUpperCase();
  container.appendChild(elem);
  return elem.id;


}
function createElementWithName(idContainer, typeOfElem, value){
  if ("undefined" === typeof value) {
    var container = document.getElementById(idContainer);
    var elem = document.createElement(typeOfElem);
    elem.name = typeOfElem + idContainer.charAt(0).toUpperCase();
    container.appendChild(elem);
    console.log("pas bien");
    return elem.name;

  }else {
    var container = document.getElementById(idContainer);
    var elem = document.createElement(typeOfElem);
    elem.id = value;
    elem.name = typeOfElem + idContainer.charAt(0).toUpperCase();
    elem.innerHTML = value;
    container.appendChild(elem);
    console.log("bien");
    return elem.name;
  }

}

function indexThTable (idTheadtr){

  var thead = document.getElementById(idTheadtr);


}

function createTableUsers(idDivTable){

  var container = document.getElementById(idDivTable);
  if(container.innerHTML != ""){

    container.innerHTML = "";

  }
  var idTable = createElementWithId(idDivTable, "table");
  console.log(idTable);
  var tableInfo = [];
  var optionDis = document.getElementById("orderDisplay").options;
  for(var i = 0; i<optionDis.length;i++){
    tableInfo.push(optionDis[i].value);
  }
  var idThead = createElementWithId(idTable, 'thead');
  console.log(idThead);
  var idTheadTr = createElementWithId(idThead, 'tr');
  console.log(tableInfo);
  tableInfo.forEach(function(infos) {
  console.log(idTheadTr);
  var content = infos;
  var infoDeg = createElementWithName(idTheadTr, 'th', content);
  console.log(infoDeg);
  var idTableTbody = createElementWithId(idTable, 'tbody');
  console.log(idTableTbody);


  })

  tableInfo.forEach((info) => {})

}



function usersPHPModeration(params){
  var header = "application/x-www-form-urlencoded";
  var contenttype = "Content-Type";
  var ajaxRequest = new XMLHttpRequest;
  var result = ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4){
      if (ajaxRequest.status == 200) {
          var str = ajaxRequest.responseText;
          var result = JSON.parse(str);
          return result
          console.log(result);
          createTableUsers(listUsers, result);

      }
      if (ajaxRequest.status == 400) {
          console.log(ajaxRequest.responseText);
      }
      if (ajaxRequest.status == 403) {
          console.log(ajaxRequest.responseText);
      }
    }
  };
  ajaxRequest.open("POST",`admin/testOrder.php`,true);
  ajaxRequest.setRequestHeader(contenttype,header);
  ajaxRequest.send(params.join("&")); //.join("&")
  console.log(this);

}


function displayPHPMod(idSession){
  var byPage = getUsersByPages('selectUsersByPages');
  console.log(byPage);
  var orderBy = getOrderDisplay('orderDisplay');
  console.log(orderBy);
  var order = getOrderOption('sortByOptionSelectUsers');
  console.log(order);
  // var idSession = "<?php echo $_SESSION['id'];?>";
  console.log(idSession);

  var params = [`byPage=${byPage}`, `orderBy=${orderBy}`, `order=${order}`, `access_token=${idSession}`];
  console.log(params);
  usersPHPModeration(params);

}

// function testIdSession(){
//
//   var idSession = "<?php echo $_SESSION['id'];?>";
//
//
// }
//
// function listUsers(){
//
//   this
//   this.getUsersByPages = getUsersByPages;
//
//
//
// }
