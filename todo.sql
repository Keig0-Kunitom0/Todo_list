drop database if exists todolist;

create database todolist default character set utf8 collate utf8_general_ci;

grant all on todo.* to 'dbuser'@'localhost' identified by 'password';

use todolist;

create table users (
    id int auto_increment primary key,
    name varchar(100) not null,
    login varchar(100) not null unique,
    password char(30) not null,
);

create table todo (
    id int auto_increment primary key,
    user_id int not null,
    title varchar(100) not null,
    comment varchar(300) not null,
    created_at timestamp not null default current_timestamp,
    foreign key(user_id) references users(id)
)

insert into users values(null,'國友圭悟','keigo','15keigo1999');
insert into todo  values(null,1,'やること','スーパーにいく',null);

