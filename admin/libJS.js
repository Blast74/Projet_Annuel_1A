function getSelectOpt(idSelect) {

  var select = document.getElementById(idSelect);
  console.log(select);
  return select.options[select.selectedIndex].value;

}

function makePagesLim(table, nbLines, page){
  var result = [];
  var firstElement = parseInt(0 + (nbLines * (page-1)))
  if (table.length <= firstElement + nbLines ){
    result = [firstElement, (table.length)];
  }else {
    result = [firstElement, parseInt(firstElement + nbLines)];
  }
  console.log(parseInt(firstElement + nbLines));
  return result;
}

function createTabBodyHTML(tableUsers, idTable, nbLines, page) {
  var table = document.getElementById(idTable);
  var tbody = document.createElement('tbody');
  tbody.id = "tbody-" + idTable;
  var makePage = makePagesLim(tableUsers, nbLines, page)
  console.log(makePage);

  for (var i = makePage[0] ; i < makePage[1]; i++) {

    console.log(nbLines -(tableUsers.length % nbLines));
    var trObj = tableUsers[i];
    console.log(tableUsers[i]);


    var tr = document.createElement('tr');
    tr.id = trObj.email;

    // console.log(trObj);
    transformToHtmlUsers(trObj, tr);

    tbody.appendChild(tr);
  }
  table.appendChild(tbody);

}

function transformToHtmlUsers(user, tr) {
  var elemPro = Object.keys(user);

  elemPro.forEach(function(property) {

    var td = document.createElement('td');
    console.log(user);
    if(property == "moderator"){
      var state = document.createElement('td');
      var modif = document.createElement('input');
      var td2 = document.createElement('td');
      var suppr = document.createElement('input');
      var td3 = document.createElement('td');
      var ena = document.createElement('input');
      var td4 = document.createElement('td');
      var up = document.createElement('input');
      var td5 = document.createElement('td');
      var down = document.createElement('input');

      state.innerHTML = user[property];
      state.headers = property;
      modif.type = "button";
      modif.value = "Modifier";
      modif.setAttribute("onclick", `modifUserInfo(this.parentNode.parentNode, "${user["email"]}")`);
      ena.type = "button";
      ena.value = "Change statut";
      ena.setAttribute("onclick", `disableUser(this.parentNode.parentNode, "${user["email"]}")`);
      up.type = "button";
      up.value = "Modération up";
      up.setAttribute("onclick", `editRight("up", "${user["email"]}")`);
      down.type = "button";
      down.value = "Modération down";
      down.setAttribute("onclick", `editRight("down", "${user["email"]}")`);
      suppr.type = "button";
      suppr.value = "Supprimer";
      suppr.setAttribute("onclick", `supprUserInfo(this.parentNode.parentNode, "${user["email"]}")`);

      td.appendChild(modif);
      td2.appendChild(suppr);
      td3.appendChild(ena);
      td4.appendChild(up);
      td5.appendChild(down);
      tr.appendChild(state);
      tr.appendChild(td);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);
      tr.appendChild(td5);

    }else{
      td.innerHTML = user[property];
      td.headers = property;
      tr.appendChild(td);
    }
  })
}

function createTabHTML(idDIV, nbLines, indexPage, tableUsers) {
  var container = document.getElementById('listUsers');
  var table = document.createElement('table');

  table.id = "table-" + idDIV;
  table.className = "table table-bordered table-responsive";
  if (document.getElementById(`${table.id}`) != null ) {
    var reset = document.getElementById(`${table.id}`);
    console.log(container);
    container.removeChild(reset);
  }
  var thead = document.createElement('thead');
  thead.id = "thead-" + idDIV;
  var valThead = Object.keys(tableUsers[0]);

  for (var i = 0; i < valThead.length; i++) {
    var th = document.createElement('th');
    if(valThead[i] == "moderator"){
      th.colSpan = "6";
    }
    th.innerHTML = valThead[i];
    thead.appendChild(th);
  }
  table.appendChild(thead);
  container.appendChild(table);
  createTabBodyHTML(tableUsers, table.id, nbLines, indexPage);

}


function sortBy(tableJSON, idCol, dir){

  tableJSON.sort(function(colA,colB){
    if (dir == "ASC") {
        console.log(colA[idCol]);
        return colA[idCol].toLowerCase() > colB[idCol].toLowerCase();
    }else {
        return colB[idCol].toLowerCase() > colA[idCol].toLowerCase();
    }
  });
    return tableJSON;
  }


  function getNbPages(table, nbLines){
    var nbPages = Math.trunc(table.length / nbLines);

    if (table.length % nbLines > 0) {
        nbPages++ ;
    }
    return nbPages;
  }

function checkTagExist(name){
  console.log(document.getElementById(name));
  return document.getElementById(name) != null ;
}

function checkTagNotCount(name, nbCount){
  if (checkTagExist(name)){
    console.log(document.getElementById(name).childElementCount);
    return document.getElementById(name).childElementCount != nbCount;
  }else{
    console.log(checkTagExist(name));
    return true;
  }
}

function buttonPage(table, nbLines, idContainer){
    var nbPages = getNbPages(table, nbLines);
    console.log(nbPages);
    console.log(checkTagNotCount(('select-divPage-'+ idContainer)));
    if(checkTagNotCount(('select-divPage-'+ idContainer), nbPages)){
      console.log(checkTagExist("divPage-" + idContainer));
      if ((checkTagExist("divPage-" + idContainer))){
        var div = document.getElementById("divPage-" + idContainer);
        div.parentNode.removeChild(div);
      }
      var div = tagButtonPage(nbPages, idContainer);
      console.log(div);
      document.getElementById(idContainer).appendChild(div);
      return "select-" + div.id;
    }else{
      return "select-divPage-"+idContainer;
    }
}

function tagButtonPage(nbPages, idCont){
  var div = document.createElement('div');
  div.id = "divPage-"+ idCont;
  div.className = "form-group";
  var h4 = document.createElement('h4');
  h4.className = "row";
  h4.innerHTML = "Page :";
  var select = document.createElement('select');
  select.className = "container";
  select.id = "select-" + div.id;
  select.setAttribute('onchange',`listHtmlUsers("${idCont}");`);
  for (var i = 1; i <= nbPages; i++) {
      var optionSelect = document.createElement('option');
      optionSelect.value = `${i}`;
      optionSelect.innerHTML = `${i}`;
      select.appendChild(optionSelect);
  }
  div.appendChild(h4);
  div.appendChild(select);
  return div;
}

function listHtmlUsers(idContainer) {
  var orderBy = getSelectOpt('orderDisplay');
  var order = getSelectOpt('sortByOptionSelectUsers');
  var nbByPage = getSelectOpt('nbByPages');
  var idSession = getCookie('access')[1];
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4){
      if (ajaxRequest.status == 200){
        var container = document.getElementById(idContainer);
        var tableUsers = JSON.parse(ajaxRequest.responseText);
        tableUsers = sortBy(tableUsers, orderBy, order);
        var currentPage = buttonPage(tableUsers, nbByPage, idContainer);
        currentPage = getSelectOpt(currentPage);
        var table2 = Object.keys(tableUsers[0]);
        createTabHTML(idContainer, parseInt(nbByPage), parseInt(currentPage), tableUsers);
      }
    }
  };
  ajaxRequest.open("GET", `admin/listUsers.php?access_token=${idSession}`, 0);
  ajaxRequest.send();
  var params = ["Pseudo", "Prénom", "Nom", "Email", "Date de naissance", "Sexe", "Pays", "Etat du compte", "Actions"];
  changeInnerHTML(params, `thead-${idContainer}`);
}
