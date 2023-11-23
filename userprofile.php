<!DOCTYPE html>
<html>
<head>
	<title>Profile Card</title>
	<link rel="stylesheet" type="text/css" href="user_styles/sample.css">
</head>

<body>

	<div class="card-container">

		<div class="upper-container">
			<div class="profile-container">
				<img id="profile-picture" src="profile.jpg" alt="Profile Picture">
               
			</div>
            <input type="file" id="profile-upload" hidden>
            <div class="camera-icon"></div>
		</div>
        

            <input type="file" id="background-upload" hidden>
                <div class="lower-container">
			<div>
				<h3>Alaina Wick</h3>
				<h4>Front-end Developer</h4>
			</div>
			<div>
				<p>sodales accumsan ligula. Aenean sed diam tristique, fermentum mi nec, ornare arcu.</p>
			</div>
			<div>
				<a href="#" class="btn">View profile</a>
			</div>
		</div>

	</div>
    <script>
     document.getElementById('profile-picture').addEventListener('click', function() {
    document.getElementById('profile-upload').click();
});

document.getElementById('profile-upload').addEventListener('change', function(event) {
    var reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById('profile-picture').src = e.target.result;
    }

    reader.readAsDataURL(event.target.files[0]);
});

document.getElementById('upload-background').addEventListener('click', function() {
            document.getElementById('background-upload').click();
        });

        document.getElementById('background-upload').addEventListener('change', function(event) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementsByClassName('background')[0].style.backgroundImage = 'url(' + e.target.result + ')';
            }

            reader.readAsDataURL(event.target.files[0]);
        });
</script>
</body>
</html>