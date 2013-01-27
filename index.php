	<?php
	$c=mysql_connect('localhost:3306','root','heaven');
	mysql_select_db('test');
	?>
	<html><head><title>map</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="jquery.min.js"></script>
	</head>
	<body>
	<div id="mapwrapper">
	<div id="collegemap">
	<img src="map.jpg" id="mainmap">
	<?php
	$cities=array();
	$q=mysql_query("SELECT DISTINCT `city` FROM `map`;",$c);
	while($res=mysql_fetch_row($q)){
		$qc=mysql_query("SELECT `college` FROM `map` WHERE `city`='{$res[0]}';");
		$l=array();
		while($resc=mysql_fetch_row($qc)){
			$l[]=$resc[0];
		}
		$cities[$res[0]]=$l;
	}
	?>
	<style>
#mapwrapper{
left: 50px;
position: relative;
}
#collegemap{
position: relative;
display: block;
width: 580px;
height: 748px;
overflow: hidden;
}
#hider{
overflow: hidden;
}
#mainmap{
	width: 580px;
	position: absolute;
	top: 0px;
	left: 0px;
	z-index: 10;
}
.citydiv{
	position: absolute;
	display: block;
	overflow: visible !important;
	width: 7px;
	height: 7px;
	z-index: 15;
}
.icon{
	width: 180%;
	margin: 0px;
	padding: 0px;
	margin-left: -60%;
	margin-top: -60%;
	border: none;
}
#nohide{
left: 600px;
position: absolute;
top: 50px;
display: block;
}
.cityhoverdiv{
	display: none;
	padding: 10px;
	width: 300px;
	color: #fff;
	margin: 3px;
	z-index: 12;
	border: 1px solid #ccc;
	background-color: rgba(40,40,40,0.4);
	border-radius: 10px;
}
.citylabeldiv{
	display: none;
	padding: 5px;
	border: 1px solid #fefefe;
	border-radius: 5px;
	font-size: 10px;
	color: #fefefe;
	font-family: Ubuntu,Calibri,sans-serif;
	position: absolute;
	margin: 15px;
	z-index: 16;
	background-color: rgba(40,40,40,0.4);
}
#city-Trichy{
left: 30px;
top: 30px;
}
#ripple1{
	position: absolute;
	z-index: 10;
	margin: 0px;
	height: 20px;
	margin-left: -7px;
	margin-top: -8px;
	padding: 0px;
	display: block;
	opacity:0.5;
}
#ripple2{
	position: absolute;
	z-index: 10;
	margin: 0px;
	height: 40px;
	margin-left: -17px;
	margin-top: -18px;
	padding: 0px;
	display: block;
	opacity:0.5;
}
#ripple3{
	position: absolute;
	z-index: 10;
	margin: 0px;
	height: 60px;
	margin-left: -27px;
	margin-top: -28px;
	padding: 0px;
	display: block;
	opacity:0.5;
}

	</style>
	<script type="text/javascript">
	$(document).ready(function(){
	obj = JSON.parse('<?php echo addcslashes(json_encode($cities),"'"); ?>');
	/*$(document).mousemove( function(e) {
	   mouseX = e.pageX;
	   mouseY = e.pageY;
	});*/
	loc=new Array();
	loc['Trichy']=[209,620,0,1];
	loc['Vallam']=[224,621,0,0];
	loc['Thanjavur']=[221,611,0,0];
	loc['Chennai']=[244,568,0,1];
	loc['Vellore']=[226,570,0,0];
	loc['Kancheepuram']=[234,572,0,0];
	loc['Sriperumbdur']=[230,582,0,0];
	loc['Madurai']=[200,643,0,1];
	loc['Salem']=[206,597,0,1];
	loc['Coimbatore']=[178,614,0,1];
	loc['Erode']=[196,602,0,0];
	loc['Karaikal']=[235,611,0,0];
	loc['Bangalore']=[186,573,0,1];
	loc['Hyderabad']=[207,483,0,1];
	loc['Vishakhapatnam']=[302,474,0,1];
	loc['Surathkal']=[130,579,0,0];
	loc['Thiruvananthapuram']=[168,667,0,1];
	loc['Calicut']=[146,605,0,1];
	loc['Vijayawada']=[253,502,0,0];
	loc['Delhi']=[184,238,0,1];
	loc['Mumbai']=[92,445,0,1];
	loc['Warangal']=[231,468,0,1];

	for( keys in obj){
		if(loc[keys][3]) w=10; else w=7;
		$('#city-'+keys).css('top',loc[keys][1]+'px').css('left',loc[keys][0]+'px').css('width',w+'px').css('height',w+'px');
		$('#citylabel-'+keys).css({'left':loc[keys][0]+'px','top':(loc[keys][1]+'px')})
		$('#city-'+keys).click(function(){
		key=$(this).attr('name');
		if($('#cityhover-'+key).css('display')=='none'){
		for(ele in loc){
			if(loc[ele][2]){
				if(loc[ele][3]) w=10; else w=7;
				loc[ele][2]=0;
				$('#city-'+ele).stop(true).animate({'width':w+'px','height':w+'px','left':loc[ele][0]+'px','top':loc[ele][1]+'px'});
				$('#cityhover-'+ele).css('display','none');
			}
		}
		loc[key][2]=1;
		$(this).stop(true).css('zIndex',14).animate({'width':'18px','height':'18px','left':(loc[key][0]-4)+'px','top':loc[key][1]-4+'px'});
		$('#cityhover-'+key).fadeIn('fast');
		}
		else{
			if(loc[key][3]) w=10; else w=7;
			loc[key][2]=0;
			key=$(this).attr('name'); $(this).stop(true).css('zIndex',15).animate({'width':w+'px','height':w+'px','left':loc[key][0]+'px','top':loc[key][1]+'px'});
		$('#cityhover-'+key).fadeOut('fast');
		};
	});
		$('#city-'+keys).mouseover(function(){
			key=$(this).attr('name');
			console.log($('#citylabel-'+key))
			$('.citylabeldiv').fadeOut('fast');
			$('#citylabel-'+key).stop(true).fadeIn('fast');
		}).mouseout(function(){
			key=$(this).attr('name');
			$('#citylabel-'+key).fadeOut('fast');
		});
	}
	$('#ripple1').css({'left':loc['Trichy'][0]+'px','top':loc['Trichy'][1]+'px'})
	$('#ripple2').css({'left':loc['Trichy'][0]+'px','top':loc['Trichy'][1]+'px'})
	$('#ripple3').css({'left':loc['Trichy'][0]+'px','top':loc['Trichy'][1]+'px'})
	window.setInterval(function(){
	$('#ripple1').animate({'width:':'200px','height':'200px','left': loc['Trichy'][0]-100+12+'px','top': loc['Trichy'][1]-100+6+'px','opacity':0},4000,function(){
		$('#ripple1').css({'width:':'20px','height':'20px','left': loc['Trichy'][0]+'px','top': loc['Trichy'][1]+'px','opacity':0.4	});
		});
	$('#ripple2').animate({'width:':'400px','height':'400px','left': loc['Trichy'][0]-200+22+'px','top': loc['Trichy'][1]-200+11+'px','opacity':0},4000,function(){
		$('#ripple2').css({'width:':'40px','height':'40px','left': loc['Trichy'][0]+'px','top': loc['Trichy'][1]+'px','opacity':0.4	});
		});
	$('#ripple3').animate({'width:':'600px','height':'600px','left': loc['Trichy'][0]-300+32+'px','top': loc['Trichy'][1]-300+16+'px','opacity':0},4000,function(){
		$('#ripple3').css({'width:':'60px','height':'60px','left': loc['Trichy'][0]+'px','top': loc['Trichy'][1]+'px','opacity':0.4	});
		});
	},4000);
	});
	</script>
	<?php
	$b='';
	foreach($cities as $c=>$k){
		$a= "<div id=\"city-{$c}\" class=\"citydiv\" name=\"{$c}\"><img src=\"./icon".($c=='Trichy'?'_main':'').".png\" alt=\"\" class=\"icon\"></div>";
		$b.="<div id=\"cityhover-{$c}\" class=\"cityhoverdiv\"><ul>";
		foreach($k as $rr)
			$b.="<li>{$rr}</li>";
		$b.= "</ul></div>";
		$a.="
		<div id=\"citylabel-{$c}\" class=\"citylabeldiv\">{$c}</div>
";
	echo "$a
";
	}
	?>
	<img id='ripple1' src='ripple.png'>
	<img id='ripple2' src='ripple.png'>
	<img id='ripple3' src='ripple.png'>
	</div>
	<?php
echo "<div id='nohide'>$b</div>";
	mysql_close($c);
	?>
	</div>
	</body>
	</html>
