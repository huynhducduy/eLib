$(function(){ 
// Lazyload ///////////////////////////////////////
$("img").each(function(){
		$(this).attr("data-original", $(this).attr("src"));
}).lazyload({
	effect : "fadeIn"
});
// Default for Toastr (Notification) /////////////////////////////////////
toastr.options = {
"closeButton": false,
"debug": false,
"newestOnTop": true,
"positionClass": "toast-bottom-left",
"preventDuplicates": false,
"onclick": null,
"showDuration": "200",
"hideDuration": "200",
"timeOut": "5000",
"extendedTimeOut": "2000",
"showEasing": "swing",
"hideEasing": "linear",
"showMethod": "fadeIn",
"hideMethod": "fadeOut"
}
// Loading effect ////////////////////////////////////
window.onload=function(){
	setTimeout(function(){$('#loading').fadeOut('slow')},1000)
}
center_vuload();
$(window).resize(function(){center_vuload()})
function center_vuload(){
	$('#vuload').css({left:($(window).width()-$('.vuload').width())/2,top:($(window).height()-$('.vuload').height())/2}) 
}
////////////////////////////////////////////////////
});