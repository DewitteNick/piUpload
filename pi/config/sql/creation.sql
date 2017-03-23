drop database if exists upload;

create database upload;

use upload;

create table `users` (
	username varchar(128),
    `password` varchar(255),
    primary key (username)
);

create table `files` (
	id int(64) auto_increment,
	username varchar(128),
    filecode varchar(128),
    filename varchar(255),
    primary key (id),
    constraint fk_username foreign key (username) references `users`(username)
);