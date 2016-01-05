$(document).ready(function(){
	$("#forward,#extension,#ivr,#ringgroup,#schedule,#confbridge,#voicemail,#queue").hide();
	switch($("#destination_type").val()){
		case 'forward':
			$("#extension,#ivr,#ringgroup,#schedule,#confbridge,#voicemail,#queue").hide();
			$("#forward").show();
		break;
		case 'extension':
			$("#forward,#ivr,#ringgroup,#schedule,#confbridge,#voicemail,#queue").hide();
			$("#extension").show();
		break;
		case 'ivr':
			$("#forward,#extension,#ringgroup,#schedule,#confbridge,#voicemail,#queue").hide();
			$("#ivr").show();
		break;
		case 'ringgroup':
			$("#forward,#extension,#ivr,#schedule,#confbridge,#voicemail,#queue").hide();
			$("#ringgroup").show();
		break;
		case 'schedule':
			$("#forward,#extension,#ivr,#ringgroup,#confbridge,#voicemail,#queue").hide();
			$("#schedule").show();
		break;
		case 'confbridge':
			$("#forward,#extension,#ivr,#ringgroup,#schedule,#voicemail,#queue").hide();
			$("#confbridge").show();
		break;
		case 'voicemail':
			$("#forward,#extension,#ivr,#ringgroup,#schedule,#confbridge,#queue").hide();
			$("#voicemail").show();
		break;
		case 'queue':
			$("#forward,#extension,#ivr,#ringgroup,#schedule,#confbridge,#voicemail").hide();
			$("#queue").show();
		break;
		default:
			$("#forward,#extension,#ivr,#ringgroup,#schedule,#confbridge,#voicemail,#queue").hide();
		break;
	}
})
$("#destination_type").change(function(){
	switch($(this).val()){
		case 'forward':
			$("#extension,#ivr,#ringgroup,#schedule,#confbridge,#voicemail,#queue").hide();
			$("#forward").show();
		break;
		case 'extension':
			$("#forward,#ivr,#ringgroup,#schedule,#confbridge,#voicemail,#queue").hide();
			$("#extension").show();
		break;
		case 'ivr':
			$("#forward,#extension,#ringgroup,#schedule,#confbridge,#voicemail,#queue").hide();
			$("#ivr").show();
		break;
		case 'ringgroup':
			$("#forward,#extension,#ivr,#schedule,#confbridge,#voicemail,#queue").hide();
			$("#ringgroup").show();
		break;
		case 'schedule':
			$("#forward,#extension,#ivr,#ringgroup,#confbridge,#voicemail,#queue").hide();
			$("#schedule").show();
		break;
		case 'confbridge':
			$("#forward,#extension,#ivr,#ringgroup,#schedule,#voicemail,#queue").hide();
			$("#confbridge").show();
		break;
		case 'voicemail':
			$("#forward,#extension,#ivr,#ringgroup,#schedule,#confbridge,#queue").hide();
			$("#voicemail").show();
		break;
		case 'queue':
			$("#forward,#extension,#ivr,#ringgroup,#schedule,#confbridge,#voicemail").hide();
			$("#queue").show();
		break;
		default:
			$("#forward,#extension,#ivr,#ringgroup,#schedule,#confbridge,#voicemail,#queue").hide();
		break;
	}
})
function moveUp(){
	var selected = $("#ring_users").find(":selected");
    var before = selected.prev();
    if (before.length > 0)
        selected.insertBefore(before);
}
function moveDown() {
    var selected = $("#ring_users").find(":selected");
    var next = selected.next();
    if (next.length > 0)
        selected.insertAfter(next);
}