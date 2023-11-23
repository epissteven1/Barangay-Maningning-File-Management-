	<!DOCTYPE html>
	<html lang="en" class="no-js">
		<head>
			<meta charset="UTF-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
			<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
			<title>Sidebar Transitions</title>
			<meta name="description" content="Sidebar Transitions: Transition effects for off-canvas views" />
			<meta name="keywords" content="transition, off-canvas, navigation, effect, 3d, css3, smooth" />
			<meta name="author" content="Codrops" />
		
			<link rel="stylesheet" type="text/css" href="css/normalize.css" />
            <link rel="stylesheet" type="text/css" href="css/icons.css" />
			<link rel="stylesheet" type="text/css" href="css/component.css" />
			<script src="js/modernizr.custom.js"></script>
		</head>
		<body>
			<div id="st-container" class="st-container">
				<div class="st-pusher">
					<nav class="st-menu st-effect-14" id="menu-14">
						<h2 class="icon icon-stack">Sidebar</h2>
						<ul>
							<li><a class="icon icon-data" href="#">Data Management</a></li>
							<li><a class="icon icon-location" href="#">Location</a></li>
							<li><a class="icon icon-study" href="#">Study</a></li>
							<li><a class="icon icon-photo" href="#">Collections</a></li>
							<li><a class="icon icon-wallet" href="#">Credits</a></li>
						</ul>
					</nav>
					<?php 
					include 'dashboard.php';
					?>

						<div class="st-content-inner"><!-- extra div for emulating position:fixed of the menu -->
							<!-- Top Navigation -->
							</header>
							<div class="main clearfix">
								<div id="st-trigger-effects" class="column">
								<button data-effect="st-effect-14" id="openMenuButton" onclick="toggleButtons()">☰</button>
                            <button id="closeMenu" style="display:none;" onclick="toggleButtons()">X</button>
								</div>
								
							</div><!-- /main -->
						</div><!-- /st-content-inner -->
					</div><!-- /st-content -->
				</div><!-- /st-pusher -->
			</div><!-- /st-container -->
			<script src="js/classie.js"></script>
		
			<script src="js/sidebarEffects.js"></script>
			<script>
        function toggleButtons() {
            var openMenuButton = document.getElementById('openMenuButton');
            var closeMenuButton = document.getElementById('closeMenu');

            openMenuButton.style.display = openMenuButton.style.display === 'none' ? 'block' : 'none';
            closeMenuButton.style.display = closeMenuButton.style.display === 'none' ? 'block' : 'none';
        }
    </script>

		</body>
	</html>