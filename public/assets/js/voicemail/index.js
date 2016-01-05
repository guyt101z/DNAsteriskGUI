$(document).ready(function(){
	var Table = $("#vmTable").dataTable({
		'bPaginate': false,
		'bInfo':false,
		'aoColumnDefs':[
			{'bVisible':false,'targets':[0]}
		],
		'bFilter':false
	});

	$("#vmTable tbody").on('click','tr',function(){
		window.location.href = '/voicemail/'+Table.fnGetData(Table.fnGetPosition(this))[0]+'/edit';
	})
})
function newVMBox(){
	window.location.href='/voicemail/create';
}