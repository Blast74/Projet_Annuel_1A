
function listUsers(nbusers, idSession, sortBy, sortByOption){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          var container = document.getElementById('userslistAjax');
          container.innerHTML = `${xmlhttp.responseText}`;
      }
  };
  xmlhttp.open("GET", `admin/listMod.php?access_token=${idSession}&nbusers=${nbusers}&sortBy=${sortBy}&sortByOption=${sortByOption}`, true);
  xmlhttp.send();
}
function AddPageTable(){

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
  listUsers(nbusers, idSession, sortBy, sortByOption);
  console.log(document.getElementById('userslistAjax').childNodes);
}
