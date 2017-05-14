<footer>
	<ul>
		<li>
			<p>
				Made by <a href="#" target="_blank">Nick Dewitte</a>
			</p>
		</li>
		<li>
			<ol>
				<li>
					<a href="readme.php" target="_blank">info</a>
				</li>
				<li>
					<a href="terms.html" target="_blank">terms</a>
				</li>
			</ol>
		</li>
	</ul>
</footer>

<script rel="script" type="text/javascript" src="assets/js/jQueryCDN3.1.1.js"></script>
<script rel="script" type="text/javascript" src="assets/js/script.js"></script>
<script src="https://use.fontawesome.com/8d2c8f6d42.js"></script>
<?php
?>
<script>
	if('serviceWorker' in navigator) {
		navigator.serviceWorker
			.register('/sw.js')
			.then(function(registration) { console.log("Service Worker Registered. Scope: " + registration.scope); });
	}
</script>
</body>
</html>


<?php

session_abort();

?>