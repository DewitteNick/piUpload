drop database if exists upload;

create database upload character set utf8 collate utf8_bin;

use upload;

create table `users` (
	username varchar(128),
    `password` varchar(255),
    emailAdress varchar(255),
    primary key (username)
);

create table settings (
	username varchar(128),
    settingName varchar(128),
    settingState varchar (128),
    primary key (username, settingName),
    constraint fk_username foreign key (username) references `users`(username)
    );