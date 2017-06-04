
function listUsers(nbusers, idSession, sortBy, sortByOption, str){
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function() {
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
          var container = document.getElementById('userslistAjax');
          container.innerHTML = `${ajaxRequest.responseText}`;
      }
  };
  ajaxRequest.open("GET", `admin/listMod.php?access_token=${idSession}`, true);
  ajaxRequest.send();
}
function changePageTable(nbPage,str){
  recupParam(str);



}
function recupParam(str){
  document.getElementById('userslistAjax').innerHTML = "";
  var test = document.getElementsByName('userModList');
  var sortBySelect = document.getElementById(`sortBySelect${str}`);
  var sortBy = sortBySelect.options[sortBySelect.selectedIndex].value;
  var sortByOptionSelect = document.getElementById(`sortByOptionSelect${str}`);
  var sortByOption = sortByOptionSelect.options[sortByOptionSelect.selectedIndex].value;
  var nbusersSelect = document.getElementById(`nbusersSelect${str}`);
  var nbusers = nbusersSelect.options[nbusersSelect.selectedIndex].value;
  var idSession = '<?php echo $_SESSION["id"]; ?>';
  listUsers(nbusers, idSession, sortBy, sortByOption, str);
  console.log(document.getElementById('userslistAjax').childNodes.tables);

}
