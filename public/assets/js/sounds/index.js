$(document).ready(function(){
	var Table = $("#soundsTable").dataTable({
		'bPaginate': false,
		'bInfo':false,
		'bFilter':false
	});

	$("#soundsTable tbody").on('click','tr',function(){
		window.location.href = '/sounds/'+Table.fnGetData(Table.fnGetPosition(this))[0]+'/edit';
	})
})
function newFile(){
	window.location.href='/sounds/create';
}