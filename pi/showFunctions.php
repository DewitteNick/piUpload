<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 18/03/2017
 * Time: 18:53
 */


function showLoginForm()
{
	?>
	<div>
		<form action="index.php" method="post">
			<fieldset>

				<label for="name">Name</label>
				<input type="text" name="name" id="name" placeholder="name" required autofocus>
				<br>
				<label for="pass">Password</label>
				<input type="password" name="pass" id="pass" placeholder="password" required>
				<br>
				<button type="submit">
					<i class="fa fa-sign-in fa-lg"></i> Log in
				</button>
			</fieldset>
		</form>

		<a href=register.php><i class="fa fa-plus-circle fa-lg"></i> Register here</a>
	</div>
	<?php
}


function showRegisterForm()
{
	?>
	<div>
		<form action="register.php" method="post">
			<fieldset>
				<label for="name">Name *</label>
				<input type="text" name="name" id="name" placeholder="username" required autofocus>
				<br>
				<label for="pass">Password *</span></label>
				<input type="password" name="pass" id="pass" placeholder="password" required>
				<br>
				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder="email">
				<br>
				<a href="terms.html" target="_blank">By registering you agree with these terms and agreements.</a>

				<button type="submit">
					<i class="fa fa-user fa-gl"></i> Create
				</button>
			</fieldset>
			<aside>Fields marked with * are mandatory</aside>
		</form>

		<a href="index.php"><i class="fa fa-address-book fa-gl"></i> Existing accounts</a>
	</div>
	<?php
}


function showUploadForm()
{
	?>
	<div>
		<form action="file.php" method="post" enctype="multipart/form-data">
			<fieldset>

				<label for="file" class="fileLabel"><img src="assets/media/custom_elements/upload.svg" alt=""><span class="fileName">Please select a file...</span></label>
				<input type="file" name="file" id="file">
				<br>
				<button type="submit">
					<i class="fa fa-cloud-upload fa-gl"></i> Upload file
				</button>

			</fieldset>
		</form>
	</div>
	<?php
}


function showSettingsForm($settings)
{
	?>
	<div>
		<form action="settings.php" method="post">
			<fieldset>
				<ul>
					<?php
					foreach($settings as $setting) {
						echo showSettingField($setting);
					}
					?>
				</ul>

				<input type="hidden" name="dummy" value="dummy">

				<button type="submit">
					<i class="fa fa-save fa-gl"></i> Save settings
				</button>

			</fieldset>
		</form>
	</div>
	<?php
}















