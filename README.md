# piUpload

Cloud service to run on my raspberry pi

### Purpose

I wanted to get started with my raspberry pi, and decided that a cloud-like service would be nice. The idea is to have a web interface to up- and download files.

##### Update: The site will be further created as a project "Mobile Web App"

### Means

I am using PHP5.6, and MySQL. My testing environment is wampserver. I am not actively using apache, so i'll see if and when I need it


### Copyright

It's on github, what do you expect to find here?

### Things to look at when using this

* How big is the maximul file you can upload with PHP? Set in:
	* `upload_max_filesize`
	* `post_max_size`
	* `memory_limit`
* You will need to create an SQL user, and change the username/password in the `Config.php` file.