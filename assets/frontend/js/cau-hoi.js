$(document).ready(function() {
	//cho tat ca noi dung thu lai 
	//$('.nd_khoi_kh').slideUp();

	// click vao the h3 
	$('.khoi_kh h3').click(function(event) {
		//$('.nd_khoi_kh').slideUp();
		//console.log('Da chay duoc hieu ung click roi ')
		$(this).next().slideToggle();
		$(this).toggleClass('xanhden');
	});

	//phan tra loi
	$('.nd_khoi_traloi').slideUp();

	// click vao the h5 
	$('.khoi_traloi h5').click(function(event) {
		$(this).next().slideToggle();
		$(this).toggleClass('xanhden');
	});
	//click vao cau hoi 1 hien ra traloi 1
	$("#traloi_cau1").show();
    //$("#traloi_cau2").hide();

    $("#cauhoi1").click(function(event){
    	//console.log('Da chay click roi ');
		$("#traloi_cau1").show();
    	$("#traloi_cau2").hide();
    	$("#traloi_cau3").hide();
    	$("#traloi_cau4").hide();
    	$("#traloi_cau5").hide();
    	$("#traloi_cau6").hide();
    	$("#traloi_cau7").hide();
    	$("#traloi_cau8").hide();
    	$("#traloi_cau9").hide();
	});
	$("#cauhoi2").click(function(event){
    	//console.log('Da chay click roi ');
		$("#traloi_cau2").show();
    	$("#traloi_cau1").hide();
    	$("#traloi_cau3").hide();
    	$("#traloi_cau4").hide();
    	$("#traloi_cau5").hide();
    	$("#traloi_cau6").hide();
    	$("#traloi_cau7").hide();
    	$("#traloi_cau8").hide();
    	$("#traloi_cau9").hide();
	});
	$("#cauhoi3").click(function(event){
    	//console.log('Da chay click roi ');
		$("#traloi_cau3").show();
    	$("#traloi_cau1").hide();
    	$("#traloi_cau2").hide();
    	$("#traloi_cau4").hide();
    	$("#traloi_cau5").hide();
    	$("#traloi_cau6").hide();
    	$("#traloi_cau7").hide();
    	$("#traloi_cau8").hide();
    	$("#traloi_cau9").hide();
	});
	$("#cauhoi4").click(function(event){
    	//console.log('Da chay click roi ');
		$("#traloi_cau4").show();
    	$("#traloi_cau1").hide();
    	$("#traloi_cau2").hide();
    	$("#traloi_cau3").hide();
    	$("#traloi_cau5").hide();
    	$("#traloi_cau6").hide();
    	$("#traloi_cau7").hide();
    	$("#traloi_cau8").hide();
    	$("#traloi_cau9").hide();
	});
	$("#cauhoi5").click(function(event){
    	//console.log('Da chay click roi ');
		$("#traloi_cau5").show();
    	$("#traloi_cau1").hide();
    	$("#traloi_cau2").hide();
    	$("#traloi_cau3").hide();
    	$("#traloi_cau4").hide();
    	$("#traloi_cau6").hide();
    	$("#traloi_cau7").hide();
    	$("#traloi_cau8").hide();
    	$("#traloi_cau9").hide();
	});
	$("#cauhoi6").click(function(event){
    	//console.log('Da chay click roi ');
		$("#traloi_cau6").show();
    	$("#traloi_cau1").hide();
    	$("#traloi_cau2").hide();
    	$("#traloi_cau3").hide();
    	$("#traloi_cau5").hide();
    	$("#traloi_cau4").hide();
    	$("#traloi_cau7").hide();
    	$("#traloi_cau8").hide();
    	$("#traloi_cau9").hide();
	});
	$("#cauhoi7").click(function(event){
    	//console.log('Da chay click roi ');
		$("#traloi_cau7").show();
    	$("#traloi_cau1").hide();
    	$("#traloi_cau2").hide();
    	$("#traloi_cau3").hide();
    	$("#traloi_cau5").hide();
    	$("#traloi_cau6").hide();
    	$("#traloi_cau4").hide();
    	$("#traloi_cau8").hide();
    	$("#traloi_cau9").hide();
	});
	$("#cauhoi8").click(function(event){
    	//console.log('Da chay click roi ');
		$("#traloi_cau8").show();
    	$("#traloi_cau1").hide();
    	$("#traloi_cau2").hide();
    	$("#traloi_cau3").hide();
    	$("#traloi_cau5").hide();
    	$("#traloi_cau6").hide();
    	$("#traloi_cau7").hide();
    	$("#traloi_cau4").hide();
    	$("#traloi_cau9").hide();
	});
	$("#cauhoi9").click(function(event){
    	//console.log('Da chay click roi ');
		$("#traloi_cau9").show();
    	$("#traloi_cau1").hide();
    	$("#traloi_cau2").hide();
    	$("#traloi_cau3").hide();
    	$("#traloi_cau5").hide();
    	$("#traloi_cau6").hide();
    	$("#traloi_cau7").hide();
    	$("#traloi_cau8").hide();
    	$("#traloi_cau4").hide();
	});
	
	
});
