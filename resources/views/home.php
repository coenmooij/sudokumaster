<!DOCTYPE html>
<html ng-app="SudokuMaster">
	<head>
		<title>SudokuMaster.net | Play Sudoku!</title>

		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="/assets/style.css">
		<link rel="stylesheet" type="text/css" href="/assets/hotkeys.min.css">
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
		<script type="text/javascript" src="/assets/hotkeys.min.js"></script>
		<script type="text/javascript" src="/assets/sudoku.js"></script>
	
	</head>
	<body>
		<div ng-controller="sudokuController" class="wrapper">
			<h1>SudokuMaster.net</h1>
			
			<div class="difficulty">
				<div class="stars">
					<i ng-repeat="star in stars" class="glyphicon glyphicon-star star"></i>
				</div>
				<div class="description">
					<h3>Difficulty: {{difficulty}} ({{numberOfStars}} star{{numberOfStars == 1 ? "" : "s"}})</h3>
				</div>
			</div>
			<div class="puzzle" >
				<table>
					<tr ng-repeat="row in puzzle">
						<td ng-repeat="item in row track by $index" ng-class=" $index == selected.cell && $parent.$index == selected.row ? 'selected' : '' " ng-click="selectCell($parent.$index,$index)">{{item == 0 ? '' : item }}</td>
					</tr>
				</table>	
			</div>

			<div class="buttons">

				<button class="btn btn-danger">
					<i class="glyphicon glyphicon-remove"></i>
					Reset
				</button>
				<button class="btn btn-primary">
					<i class="glyphicon glyphicon-ok"></i>
					Check Sudoku
				</button>
				<button class="btn btn-success">
					<i class="glyphicon glyphicon-play"></i>
					New Game
				</button>
			</div>
		</div>
	</body>
</html>