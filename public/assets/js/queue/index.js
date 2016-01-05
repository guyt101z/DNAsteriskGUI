$(document).ready(function(){
	var Table = $("#queueTable").dataTable({
		'bPaginate': false,
		'bInfo':false,
		'aoColumnDefs':[
			{'bVisible':false,'targets':[0]}
		],
		'bFilter':false
	});

	$("#queueTable tbody").on('click','tr',function(){
		window.location.href = '/queue/'+Table.fnGetData(Table.fnGetPosition(this))[0]+'/edit';
	})
})
function newQueue(){
	window.location.href='/queue/create';
}