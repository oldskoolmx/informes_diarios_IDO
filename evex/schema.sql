create database events;
use events;

create table event(
	id int not null auto_increment primary key,
	date_at date,
	title varchar(255),
	description text
);
