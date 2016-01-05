$(document).ready(function(){
	var Table = $("#rgTable").dataTable({
		'bPaginate': false,
		'bInfo':false,
		'aoColumnDefs':[
			{'bVisible':false,'targets':[0]}
		],
		'bFilter':false
	});

	$("#rgTable tbody").on('click','tr',function(){
		window.location.href = '/ringgroups/'+Table.fnGetData(Table.fnGetPosition(this))[0]+'/edit';
	})
})
function newRG(){
	window.location.href='/ringgroups/create';
}