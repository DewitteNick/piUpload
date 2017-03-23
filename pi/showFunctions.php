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

                <input type="submit">
            </fieldset>
        </form>

        <a href=register.php>Register here</a>
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

                <a href="terms.html" target="_blank">By registering you agree with the terms and agreements listed
                    here.</a>

                <input type="submit">
            </fieldset>
        </form>

        <a href="index.php">Existing accounts</a>
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

            <input type="submit">

        </fieldset>
    </form>
    <?php
}















