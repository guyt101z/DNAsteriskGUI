$(document).ready(function(){
	var Table = $("#speedDialTable").dataTable({
		'bPaginate': false,
		'bInfo':false,
		'aoColumnDefs':[
			{'bVisible':false,'targets':[0]}
		],
		'bFilter':false
	});

	$("#speedDialTable tbody").on('click','tr',function(){
		window.location.href = '/speeddials/'+Table.fnGetData(Table.fnGetPosition(this))[0]+'/edit';
	})
})
function newSpeedDial(){
	window.location.href='/speeddials/create';
}