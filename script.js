let edit = null;
let editColumn = null;
let editId = null;
let editTable = null;

document.addEventListener("keydown",checkForEnter);
function checkForEnter(key){
  if(key.keyCode == 13 && edit){
    endEdit();
  }
}

function startEdit(elem, column, id, table) {
  if(edit) {
    endEdit();
  }
  edit = elem;
  editColumn = column;
  editId = id;
  editTable = table;
  elem.readOnly = false;
}

function endEdit(){
  xmlhttp = new XMLHttpRequest();
  let data = 'column='+editColumn+'&editval='+edit.value+'&id='+editId+'&table='+editTable;
  xmlhttp.open("POST", "saveedit.php", true);
  xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=utf-8');
  xmlhttp.send(data);

  let node = edit.parentNode;
  node.style.backgroundColor = "white";
  let p = document.createElement('p');
  let textNode;
  if(edit.nodeName == 'SELECT'){
    textNode = document.createTextNode(edit.options[edit.selectedIndex].text);
  }
  else {
    textNode = document.createTextNode(edit.value);
  }
  node.innerHTML = '';
  p.appendChild(textNode);
  node.appendChild(p);

  edit = null;
  editColumn = null;
  editId = null;
  editTable = null;
}

function startEditInput(elem, column, id, table, inputType){
  let value = elem.getElementsByTagName('p')[0].textContent;
  elem.innerHTML = '';
  let node = document.createElement("input");
  node.type = inputType;
  node.value = value;
  elem.appendChild(node);
  startEdit(node, column, id, table);
  elem.style.backgroundColor = "lightyellow";
}

function startEditSelect(elem, column, id, table){
  let value = elem.getElementsByTagName('p')[0].textContent;
  elem.innerHTML = '';
  let node = document.createElement("select");
  elem.appendChild(node);
  addOption(node, value);
  startEdit(node, column, id, table);
  elem.style.backgroundColor = "lightyellow";
}
function addOption(elem, value){
   for(let i=0; i<arr.length; i++)
   {
    let node = document.createElement("option");
    if(value==arr[i]["pc"])
    node.selected = true;
    let textnode = document.createTextNode(arr[i]["pc"]);
    node.appendChild(textnode);
    node.value = arr[i]["id"];
    elem.appendChild(node);
   }
}