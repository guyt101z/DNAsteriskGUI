$(document).ready(function(){
	var Table = $("#confTable").dataTable({
		'bPaginate': false,
		'bInfo':false,
		'aoColumnDefs':[
			{'bVisible':false,'targets':[0]}
		],
		'bFilter':false
	});

	$("#confTable tbody").on('click','tr',function(){
		window.location.href = '/conf/'+Table.fnGetData(Table.fnGetPosition(this))[0]+'/edit';
	})
})
function newConf(){
	window.location.href='/conf/create';
}