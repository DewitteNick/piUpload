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
                <input type="text" name="name" id="name" autofocus>

                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass">

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
                <label for="name">Name</label>
                <input type="text" name="name" id="name" autofocus>

                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass">

                <label for="pass2">Repeat password</label>
                <input type="password" name="pass2" id="pass2">

                <a href="terms.html" target="_blank">By registering you agree with these terms and agreements.</a>

                <button type="submit">
					<i class="fa fa-user fa-gl"></i> Create account
				</button>
            </fieldset>
        </form>

        <a href="index.php"><i class="fa fa-address-book fa-gl"></i> Existing accounts</a>
    </div>
    <?php
}


function showUploadForm()
{
    ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <fieldset>

            <label for="file">Select a file</label>
            <input type="file" name="file" id="file">

            <button type="submit">
				<i class="fa fa-cloud-upload fa-gl"></i> Upload file
			</button>

        </fieldset>
    </form>
    <?php
}















