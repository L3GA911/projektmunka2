//--------------------AJAX--------------------
function firm_delete(firm_id) {
		   $.ajax({url:"superadmin.php", type:"POST", data: ({firm_id: firm_id}), async:true, cache:false, success:function(result)
		{
			// $("#content").html(result);
			pageLoad('sa_firm_delete');
		}});
}

function list_firm_users(firm_id) {
		   $.ajax({url:"query_handler.php", type:"POST", data: ({firm_id: firm_id}), async:true, cache:false, success:function(result)
		{
			$("#list").html(result);
		}});
}

function user_delete_sa(user_id, firm_id) {
		   $.ajax({url:"superadmin.php", type:"POST", data: ({user_id: user_id}), async:true, cache:false, success:function(result)
		{
			list_firm_users(firm_id); //a törlés után meghívjuk a függvényt
		}});
}

function user_delete_p(user_id) {
       $.ajax({url:"profiles.php", type:"POST", data: ({user_id: user_id}), async:true, cache:false, success:function(result)
    {		
      	pageLoad('p_delete');
    }});
}

function new_pos() {
  pos_name = $("#position").val();
  $.ajax({url:"profiles.php", type:"POST", data: ({pos_name: pos_name}), async:true, cache:false, success:function(result)
{		
   pageLoad('p_positions');
}});
}

function pos_delete_p(pos_id) {
  $.ajax({url:"profiles.php", type:"POST", data: ({pos_id: pos_id}), async:true, cache:false, success:function(result)
{		
   pageLoad('p_positions');
}});
}

//----------------------------------------------
function pageLoad(page) {
	$("#content").load("menu_" + page + ".php");
}

function addInput() {
    let value = document.getElementById("numbersOfChildren").value;

    const collection = document.querySelectorAll('.rem');

    for (let i = 0; i < collection.length; i++) {
        collection[i].remove();
    }

    for (i = 1; i <= value; i++) {
        let x = document.createElement("INPUT");
        x.setAttribute("type", "date");
        x.setAttribute("id", i);
        x.setAttribute("name", "child"+i);
        x.setAttribute("class", "rem");
        document.getElementById("form").insertBefore(x, document.getElementById("button"));

        let y = document.createElement("BR");
        y.setAttribute("class", "rem");
        document.getElementById("form").insertBefore(y, document.getElementById(i));

        let z = document.createElement("LABEL");
        let t = document.createTextNode(i + ". gyermek születési ideje");
        z.setAttribute("for", i);
        z.setAttribute("class", "rem");
        z.appendChild(t);
        document.getElementById("form").insertBefore(z, document.getElementById(i));

        let w = document.createElement("BR");
        w.setAttribute("class", "rem");
        document.getElementById("form").insertBefore(w, document.getElementById(i));

    }
}

function open_list() {
  document.getElementById("dropdown_list").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("dropdown_search");
  filter = input.value.toUpperCase();
  div = document.getElementById("dropdown_list");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}