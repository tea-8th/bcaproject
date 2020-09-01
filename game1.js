

	var statTotalTime = null;
	var statStart = new Date().getTime();



var start = new Date().getTime();


function getRandomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}


function makeShapeAppear(){
	var top = Math.random() * 300;
	var left = Math.random() * 1000;
	var width = (Math.random() * 150) + 50;
	
	if(Math.random() > 0.5){
		document.getElementById("shape").style.borderRadius = "50%";
	} else{
		document.getElementById("shape").style.borderRadius = "0";
	}
	
	document.getElementById("shape").style.backgroundColor = getRandomColor();
	document.getElementById("shape").style.width = width + "px";
	document.getElementById("shape").style.height = width + "px";
	document.getElementById("shape").style.top = top + "px";
	document.getElementById("shape").style.left = left  + "px";
	document.getElementById("shape").style.display = "block";
	start = new Date().getTime();
}


function appearAfterDelay(){
	setTimeout(makeShapeAppear,Math.random()*2000);
}
	var player1 = "";
	var player2 = "";
	document.getElementById("ready").onclick = function(){
	player1 = document.getElementById("player1Name").value;
	document.getElementById("p1NameChange").innerHTML = player1 + "\'s" + " turn";
		
	player2 = document.getElementById("player2Name").value;
	document.getElementById("p2NameChange").innerHTML = player2 + "\'s" + " turn";
	}
	
	
	var total1 = 0;
	document.getElementById("p1ready").onclick = function(){
		appearAfterDelay();
		var j = 0;
		document.getElementById("shape").onclick = function(){
			if(j < 10){
			document.getElementById("shape").style.display = "none";
			j = j + 1;
			var end = new Date().getTime();
			var timeTaken = (end-start)/1000;
			document.getElementById("timeTaken1").innerHTML = timeTaken.toFixed(2) + "s" + " Turns complete:" +j;
			total1 =total1+timeTaken;
			document.getElementById("total1").innerHTML = total1.toFixed(2) + "s";
			appearAfterDelay();
			}else{
				document.getElementById("timeTaken1").innerHTML = "OUT of turns";
			}
		
		}
	}
	
	document.getElementById("p2ready").onclick = function(){
		appearAfterDelay();
		var total2 = 0;
		var j = 0;
		document.getElementById("shape").onclick = function(){
			if(j < 10){
			document.getElementById("shape").style.display = "none";
			j = j + 1;
			var end = new Date().getTime();
			var timeTaken = (end-start)/1000;
			document.getElementById("timeTaken2").innerHTML = timeTaken.toFixed(2) + "s" + " Turns complete:" +j;
			total2 =total2+timeTaken;
			document.getElementById("total2").innerHTML = total2.toFixed(2) + "s";
			appearAfterDelay();
			}else{
				document.getElementById("timeTaken2").innerHTML = "OUT of turns";
				if(total1 < total2){
					document.getElementById("score").innerHTML = "The winner is:" +player1;
				}else if(total1 > total2){
					document.getElementById("score").innerHTML = "The winner is:" +player2;
				}else{
					document.getElementById("score").innerHTML = "The match is draw";
				}
			}
		
		}
	}
	
	

document.getElementById("statTime").onclick = function(){
		var statEnd = new Date().getTime();
		statTotalTime = (statEnd-statStart)/60000;
		window.location.href="tygame1.php?time=" + statTotalTime.toFixed(2);
}
	
	
	
