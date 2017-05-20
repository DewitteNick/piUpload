<?php


// HEADERS TO SET FOR ALL REQUESTS
header('Service-Worker-Allowed: /');


// Security headers. These headers protect innocent people against malicious use of the site.
// They do not stop people with bad intentions to do nasty stuff

$cspPolicy = "Content-Security-Policy:"
	."script-src 'self' use.fontawesome.com";
header($cspPolicy);


$xfoPolicy = "X-Frame-Options:"
	."DENY";
header($xfoPolicy);


$xssPolicy = "X-XSS-Protection:"
	."1; mode=block";
header($xssPolicy);


$xctPolicy = "X-Content-Type-Options:"
	."nosniff";
header($xctPolicy);
/**/
//HttpOnly flag: see php php.ini settings ->session.cookie_httponly = True
//Directory Listing: see apache httpd.conf -> Options -Indexes