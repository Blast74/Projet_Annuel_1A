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
    transformToHtml(trObj, tr);

    tbody.appendChild(tr);
  }
  table.appendChild(tbody);

}

function transformToHtml(user, tr) {
  var elemPro = Object.keys(user);

  elemPro.forEach(function(property) {

    var td = document.createElement('td');

    td.innerHTML = user[property];
    td.headers = property;

    tr.appendChild(td);

  })
}

function createTabHTML(idDIV, nbLines, indexPage, tableUsers) {
  var container = document.getElementById('listUsers');
  var table = document.createElement('table');

  table.id = "table-" + idDIV;
  table.style = "width: 100%";
  if (document.getElementById(`${table.id}`) != null ) {
    var reset = document.getElementById(`${table.id}`);
    console.log(container);
    container.removeChild(reset);
  }


  var thead = document.createElement('thead');
  thead.id = "thead-" + idDIV;
  var trThead = document.createElement('tr');
  trThead.id = "trTh-" + idDIV;
  var valThead = Object.keys(tableUsers[0]);

  for (var i = 0; i < valThead.length; i++) {
    var th = document.createElement('th');
    th.innerHTML = valThead[i];
    thead.appendChild(th);
  }

  thead.appendChild(trThead);
  table.appendChild(thead);
  container.appendChild(table);
  createTabBodyHTML(tableUsers, table.id, nbLines, indexPage);

}


function sortBy(tableJSON, idCol, dir){

  tableJSON.sort(function(colA,colB){
    if (dir == "ASC") {
        console.log(colA[idCol]);
        return colA[idCol] > colB[idCol];
    }else {
        return colB[idCol] > colA[idCol];
    }
  });
    return tableJSON;
  }

  function sortAsc(a, b, nameCol, direc){
    if (direc == ASC){
      if (a[nameCol] < b[nameCol]){
        return (-1);
      }else if (a[nameCol] > b[nameCol]) {
        return 1;
      }else{
        return 0;
      }
    }else {
      if (a[nameCol] > b[nameCol]){
        return (-1);
      }else if (a[nameCol] < b[nameCol]) {
        return 1;
      }else{
        return 0;
      }
    }
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
  var p = document.createElement('p');
  p.innerHTML = "Page :";
  var select = document.createElement('select');
  select.id = "select-" + div.id;
  for (var i = 1; i <= nbPages; i++) {
      var optionSelect = document.createElement('option');
      // option.onclick = "";
      optionSelect.value = `${i}`;
      optionSelect.innerHTML = `${i}`;
      select.appendChild(optionSelect);
  }
  div.appendChild(p);
  div.appendChild(select);
  return div;
}


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


function listUsers(idContainer) {
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
  ajaxRequest.open("GET", `admin/testOrder.php?access_token=${idSession}`, true);
  ajaxRequest.send();
}
