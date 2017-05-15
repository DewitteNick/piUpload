# Progress tracker

##

### 2017-05-09

##### 2017-05-09.1

 * UI updated. Started a CRUD implementation. Using Ajax atm, changing to fetch soon.
 * CSS updated
 * (sligtly?) Better page structure

### 2017-04-04

##### 2017-04-04.1

* Security, yay! passwords are now hashed.

### 2017-03-31

##### 2017-03-31.1

###### Going live! V0.1

* Screen-size specific CSS (only desktop(+600px width) is present)
* TODO: FIX
	* passwords are plain text. That's fine, right?
	* perhaps change te sql account to something that's less insecure? maaybe? and maybe get that out of GIT as well?
	* TBA

### 2017-03-30

##### 2017-03-30.3

* Some CSS
*  Font awesome is awesome!

##### 2017-03-30.2

* Fixed uploading same file for different users.
* Fixed gibberish that was added to downloaded files.

##### 2017-03-30.1

* Addition of the progress file.
* User is able to create account, upload, download and delete files
* CSS? what's that?
* Several errors are still present:
	* No two users can upload the same file.
	* If anything happens between the files folder and the sql table about files, there is no way of knowing, and this will cause bugs.
	* Security? what's that?