$(document).ready(function(){
	$('#wrap').load('index.php');

	$('.menu_top').click(function(){
		var page= $('.menu_top').attr('href');
		$('#w').load(page + '.php');
		return false;
	});
});