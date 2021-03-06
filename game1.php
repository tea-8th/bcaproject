


<html>
	<head>
		<title>Reaction Timer</title>
		<link rel="stylesheet" type="text/css" href="game1.css">
	</head>
	<body>
		<div id="topbar-container">
			<div id="logo">
				<a href="homepage.html"><img id="topbarlogo" src="logo.png"></a>
			</div>
			<div id="topbarname" id="logoname">
				<a href="homepage.html"><img src="logoname.png"></a>
			</div>
			<div class="topbar"><a class="topbar-link" href="about.html">About</a></div>
			<div class="topbar"><a class="topbar-link" href="support.html">Support</a></div>
		</div>
		<div class="clear"></div>
		<div id="contentspace">
			<div id="maincontent-container">
				<h1>Test Your Reaction</h1><div><p> Click here to go back: <a id="pointer"><button id="statTime">EXIT</button></a></p></div>
				<p>Click on the boxes and circles as quickly as you can! You have only <b>10</b> turns per player</p>
				<p>
					<label>Enter player 1 name:</label><input type="text" id="player1Name"></input>
					<label>Enter player 2 name:</label><input type="text" id="player2Name"></input>
					<button id="ready">Ready</button>
				</p>
				<div id="p1">
					<p class="bold" id="p1NameChange">turn</p>
					<p class="bold">Your time: <span id="timeTaken1"></span></p>
					<p class="bold">Total time:<span id="total1"></span></p>
				</div>
				<div id="readydiv">
					<button id="p1ready">Player-1 Start</button>
					<button id="p2ready">Player-2 Start</button>
					<div id="score">The winner is:</div>
				</div>
				<div id="p2">
					<p class="bold" id="p2NameChange">turn<p>
					<p class="bold">Your time: <span id="timeTaken2"></span></p>
					<p class="bold">Total time:<span id="total2"></span></p>
				</div>
				<div class="clear"></div>
				<div id="shape"></div>
			</div>
		</div>
		<script type="text/javascript" src="game1.js"></script>
	</body>
</html>