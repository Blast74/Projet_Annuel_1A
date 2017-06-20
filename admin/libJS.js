function getSelectOpt(idSelect) {

  var select = document.getElementById(idSelect);
  console.log(select);
  return select.options[select.selectedIndex].value;

}

function makePagesLim(table, nbLines){
  var result = [];
  var lengthTab = table.length;
  for (var i = 0; i < (Math.trunc(lengthTab / nbLines)); i++) {
    result[i] = nbLines;
  }
  if(lengthTab % nbLines != 0){
    result += lengthTab % nbLines;
  }
  console.log(result);
  console.log(lengthTab);
  console.log(Math.trunc(lengthTab / nbLines));
  return result;
}

function createTabBodyHTML(tableUsers, idTable, nbLines, page) {
  var table = document.getElementById(idTable);
  var tbody = document.createElement('tbody');
  tbody.id = "tbody-" + idTable;
  var makePage = makePagesLim(tableUsers, nbLines)
  console.log(makePage);

  for (var i = (0 + (nbLines * (page-1))); i < makePage[page-1]; i++) {

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
  // console.log(tr);

  // console.log(elemPro);
  elemPro.forEach(function(property) {

    // console.log(property);
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
  createTabBodyHTML(tableUsers, table.id, nbLines, 1);

}


function sortBy(tableJSON, idCol, dir){

  tableJSON.sort(function(colA,colB){
    if (dir == "ASC") {
        return colA[idCol] > colB[idCol];
    }else {
        return colB[idCol] > colA[idCol];
    }
  });
    return tableJSON;
  }

function buttonPage(table, nbLines, idContainer){
    var container = document.getElementById(idContainer);
    var div = document.createElement('div');
    div.id = "divPage-"+ idContainer;
    console.log(document.getElementById(div.id));

    if(document.getElementById(div.id) == null){
        var p = document.createElement('p');
        p.innerHTML = "Page";
        var select = document.createElement('select');
        select.id = "select-" + div.id;
        var nbPages = table.length / nbLines;

        if (table.length % nbLines > 0) {
            nbPages++ ;
        }
        for (var i = 1; i <= nbPages; i++) {
            var optionSelect = document.createElement('option');
            optionSelect.value = `${i}`;
            optionSelect.innerHTML = `${i}`;
            console.log(optionSelect);
            select.appendChild(optionSelect);
        }

        div.appendChild(p);
        div.appendChild(select);
        container.appendChild(div);
        return getSelectOpt(`${select.id}`);

    }else {
      return getSelectOpt(`${"select-" + div.id}`);
    }


}


function listUsers(idSession, idContainer) {
  var orderBy = getSelectOpt('orderDisplay');
  var order = getSelectOpt('sortByOptionSelectUsers');
  var nbByPage = getSelectOpt('nbByPages');
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function() {
    if (ajaxRequest.readyState == 4) {
      if (ajaxRequest.status == 200) {
        var container = document.getElementById(idContainer);
        var tableUsers = JSON.parse(ajaxRequest.responseText);
        tableUsers = sortBy(tableUsers, orderBy, order);
        var currentPage = buttonPage(tableUsers, nbByPage, idContainer);
        console.log(tableUsers);
        console.log(Object.keys(tableUsers));
        var table2 = Object.keys(tableUsers[0]);
        console.log(nbByPage);
        createTabHTML(idContainer, nbByPage, currentPage, tableUsers);


      }

    }
  };
  ajaxRequest.open("GET", `admin/testOrder.php?access_token=${idSession}`, true);
  ajaxRequest.send();
}
