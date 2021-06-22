//--------------------AJAX--------------------
function form_ajax(form_id){
	
	$(form_id).on('submit', function(){
		var that = $(this),
			url = that.attr('action'),
			type = that.attr('method'),
			data = {};
			
		that.find('[name]').each(function(index, value){
			var that = $(this),
				name = that.attr('name'),
				value = that.val();
				
			data[name] = value;
		});
		
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				$("#modal").html(response);
			}
		});
		
		return false;
	});
}

function freedays_modal(date, userid, add_or_delete) {
		   $.ajax({url:"w_dayoff_modal.php", type:"POST", data: ({date: date, userid: userid, aord: add_or_delete}), async:true, cache:false, success:function(result)
		{	$(".modal-dialog").html(result);
		}});
}
function wo_delete_modal(fd_id) {
		   $.ajax({url:"wo_delete_modal.php", type:"POST", data: ({fd_id: fd_id}), async:true, cache:false, success:function(result)
		{	$(".modal-dialog").html(result);
		}});
}
function freedays_acc_dec(date, userid, add_or_delete) {
		   $.ajax({url:"w_dayoff_acc_dec_query.php", type:"POST", data: ({date: date, userid: userid, aord: add_or_delete}), async:true, cache:false, success:function(result)
		{
			$('#'+userid).html(result);
		}});
}
function freedays_delete(fd_id) {
		   $.ajax({url:"wo_delete_query.php", type:"POST", data: ({fd_id: fd_id}), async:true, cache:false, success:function(result)
		{	
			$(".fillin").html(result);
		}});
}
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

function user_delete_sa(user_id, firm, owner) {
		   $.ajax({url:"superadmin.php", type:"POST", data: ({user_id: user_id, firm: firm, owner: owner}), async:true, cache:false, success:function(result)
		{
			list_firm_users(firm); //a törlés után meghívjuk a függvényt
		}});
}
function user_delete_p_modal(user_id_modal) {
		   $.ajax({url:"p_delete_modal.php", type:"POST", data: ({user_id_modal: user_id_modal}), async:true, cache:false, success:function(result)
		{	$(".modal-dialog").html(result);
		}});
}
function delete_pos_modal(pos_id_modal) {
		   $.ajax({url:"p_delete_pos_modal.php", type:"POST", data: ({pos_id_modal: pos_id_modal}), async:true, cache:false, success:function(result)
		{	$(".modal-dialog").html(result);
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
  posmaxfreedays = $("#posmaxfreedays").val();
  $.ajax({url:"profiles.php", type:"POST", data: ({pos_name: pos_name, posmaxfreedays: posmaxfreedays}), async:true, cache:false, success:function(result)
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
        document.getElementsByClassName("child_selector")[0].insertBefore(x, document.getElementsByClassName("javasq_button")[0]);

        let z = document.createElement("LABEL");
        let t = document.createTextNode(i + ". gyermek születési ideje");
        z.setAttribute("for", i);
        z.setAttribute("class", "rem");
        z.appendChild(t);
        document.getElementsByClassName("child_selector")[0].insertBefore(z, document.getElementById(i));

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