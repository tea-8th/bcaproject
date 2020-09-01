

	var statTotalTime = null;
	var statStart = new Date().getTime();



document.getElementById("ready").onclick = function(){
	var player1 = "";
	var player2 = "";
	var win = 0;
	var p1 = 1;
	var p2 = 1;
	var b1 = 0; var b2 = 0; var b3 = 0; var b4 = 0; var b5 = 0; var b6 = 0; var b7 = 0; var b8 = 0; var b9 = 0; 
	var i = 1;
	while(var win == 0){
		if(p1 == 1){
			player1 = document.getElementById("player1Name").value;
			document.getElementById("turn").innerHTML = player1 + "\'s" + " turn";
			for(i=1;i<=9;i++){
				if(b1 == 0){
					document.getElementById("box1").onclick
					}
			}
			p1=0; p2=0;
			
		}else if(p2 == 0){
			player2 = document.getElementById("player2Name").value;
			document.getElementById("turn").innerHTML = player2 + "\'s" + " turn";
		}
	}
}
	
	

document.getElementById("statTime").onclick = function(){
		var statEnd = new Date().getTime();
		statTotalTime = (statEnd-statStart)/60000;
		window.location.href="tygame1.php?time=" + statTotalTime.toFixed(2);
}
	
	
	
