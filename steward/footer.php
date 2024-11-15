<style>
	#footer {
		font-family: Arial, sans-serif;
		left: 0;
		right: 0;
	}

	.footer-content {
		padding: 5px 10%;
	}

	.btn-2 {
		font-family: sans-serif;
		font-weight: bold;
		font-size: 16px;
		background-color: #ffb700;
		color: #000;
		border: none;
		padding: 10px 20px;
		text-decoration: none;
		margin-top: 10px;
	}

	.footer-one .btn:hover {
		background: #0865a3;
	}

	.footer-two .btn-2:hover {
		background: orange;
	}

	.footer-container {
		display: flex;
		justify-content: space-between;
		align-items: center;
		max-width: 1200px;
		margin: auto;
	}

	.footer-logo {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.footer-logo img {
		width: 150px;
		/* Adjust as required */
		margin-bottom: 5px;
	}

	.footer-content {
		display: flex;
		justify-content: space-between;
		flex-grow: 1;
	}

	.footer-section {
		margin-right: 20px;
	}

	.footer-section h4 {
		color: #333;
		margin-bottom: 10px;
	}

	.footer-section ul {
		list-style-type: none;
		padding: 0;
	}

	.footer-section ul li a {
		color: #000000;
		text-decoration: none;
		line-height: 2;
	}

	.footer-three .logos img {
		width: 200px;
	}

	.footer-one {
		background-color: #ffb700;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.footer-one h2 {
		font-family: "DM Sans", sans-serif;
		font-size: 40px;
		font-optical-sizing: auto;
		font-weight: 200;
		font-style: normal;
		color: #000;
		margin: 0 auto;
	}

	.footer-two {
		background-color: rgb(211, 211, 211);
		padding-top: 30px;
	}

	.footer-three {
		background-color: rgb(211, 211, 211);
		display: flex;
		flex-direction: row;
		justify-content: center;
	}

	.footer-three .icons {
		display: flex;
		align-items: center;
		padding-right: 10px;
		margin-right: 10px;
	}

	.footer-three .icons a {
		padding: 5px;
		color: #000;
		transition: all .4s ease;
	}

	.footer-three .icons a:hover {
		color: #fff;
		background-color: #ffb700;
		transform: translateX(-5px) translateY(-3px);
	}

	.footer-three .icons a img {
		width: 40px;
	}

	.footer-three .icons a i {
		font-size: 30px;
	}

	.footer-four {
		background-color: rgb(110, 110, 110);
		height: 40px;
	}

	.footer-three .logos {
		display: flex;
		flex-direction: row;
		align-items: center;
	}

	.footer-three .logos img {
		width: 100px;

	}

	.footer-four {
		background-color: rgb(110, 110, 110);
		color: #fff;
		font-size: 14px;
		height: 80px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	@media screen and (max-width: 800px) {
		#footer {
			margin: 0;
			padding: 0;
			width: 100%;
		}

		.footer-logo {
			padding-bottom: 20px;
			margin-bottom: 20px;
			border-bottom: 2px solid #000;
		}

		.footer-one {
			flex-direction: column;
			gap: 20px;
			padding: 10px auto;
		}

		.footer-two {
			display: flex;
			flex-direction: column;
			align-items: left;
			margin: auto;
		}

		.footer-section h2 {
			font-weight: bold;
		}

		.footer-three {
			display: flex;
			align-content: center;
			align-items: center;
			flex-direction: column;
			justify-content: center;
		}

		.footer-three .logos {
			border-top: 2px solid #000;
			margin-top: 10px;
			padding-top: 10px;
		}

		.footer-three .icons {
			padding-right: 0;
			margin-right: 0;
			border-right: none;
			padding-right: 5px;
			margin-right: 5px;
		}

		.footer-three .icons a img {
			width: 40px;

		}

		.footer-four {
			justify-content: center;
			text-align: center;
			font-size: 14px;
		}
	}
</style>
<footer id="footer">
	<div class="footer-content footer-two">
		<div class="footer-logo">
			<!-- Placeholder for Logo, replace with actual image -->
			<a><img src="../../assets/img/logo.png" alt="Your Logo"></a>

		</div>
		<div class="footer-section">
			<h4>About Us</h4>
			<ul>
				<li><a href="">About</a></li>
				<li><a href="">Contact</a></li>
				<li><a href="">FAQ</a></li>
			</ul>
		</div>
		<div class="footer-section">
			<h4>Services Information</h4>
			<ul>
				<li><a href="#">Book Place</a></li>
				<li><a href="">This Week</a></li>
				<!-- Add more links as needed -->
			</ul>
		</div>
		<div class="footer-section">
			<h4>Other</h4>
			<ul>
				<li><a href="#">Suggestions</a></li>
				<li style="margin-top: 20px;"><a class="btn-2" id="booking-btn">Log In</a></li>
				<!-- Add more links as needed -->
			</ul>
		</div>
	</div>
	<div class="footer-content footer-three">
		<div class="icons">
			<a><img src="../../assets/transparent_logos/03_instagram.png" alt="Instagram Icon"></a>
			<a><img src="../../assets/transparent_logos/01_facebook.png" alt="facebook Icon"></a>
			<a><img src="../../assets/transparent_logos/05_linkedin.png" alt="linked-In Icon"></a>
			<a><img src="../../assets/transparent_logos/04_youtube.png" alt="youtube Icon"></i></a>
			<a><img src="../../assets/transparent_logos/02_whatsapp.png" alt="Whatsapp Icon"></a>
			<a><img src="../../assets/transparent_logos/06_twitter.png" alt="twittwe(X) Icon"></i></a>
			<!-- <a href="https://www.twitter.com/depictureprod"><i class="fa-brands fa-x-twitter"></i></a>
			<a href="mailto:info@depicture.media" ><i class="far fa-envelope"></i></a> -->
		</div>
	</div>
	<div class="footer-content footer-four">&copy; citizens 2023. All rights reserved.</div>
</footer>