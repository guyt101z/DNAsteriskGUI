$(document).ready(function(){
	var Table = $("#userTable").dataTable({
		'bPaginate': false,
		'bInfo':false,
		'aoColumnDefs':[
			{'bVisible':false,'targets':[0]}
		],
		'bFilter':false
	});

	$("#userTable tbody").on('click','tr',function(){
		window.location.href = '/user/'+Table.fnGetData(Table.fnGetPosition(this))[0]+'/edit';
	})
})
function newUser(){
	window.location.href="/user/create";
}