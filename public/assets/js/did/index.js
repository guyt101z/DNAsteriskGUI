$(document).ready(function(){
	var Table = $("#didTable").dataTable({
		'bPaginate': false,
		'bInfo':false,
		'aoColumnDefs':[
			{'bVisible':false,'targets':[0]}
		],
		'bFilter':false
	});

	$("#didTable tbody").on('click','tr',function(){
		window.location.href = '/did/'+Table.fnGetData(Table.fnGetPosition(this))[0]+'/edit';
	})
})