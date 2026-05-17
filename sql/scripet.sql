

create database if not exists tangier_blog;

use tangier_blog;

create table if not exists users (
    id_user int auto_increment primary key,
    user_name varchar(100) not null,
    email varchar(150) not null unique,
    password varchar(255) not null,
    role enum('user', 'admin') default 'user',
    created_at timestamp default current_timestamp
);



create table if not exists categories (
    id_category int auto_increment primary key,
    cat_name varchar(100) not null unique,
    created_at timestamp default current_timestamp
);



create table if not exists posts (
    id_post int auto_increment primary key,
    category_id int not null,
    user_id int null,
    approved_by int null,
    title varchar(255) not null,
    slug varchar(255) not null unique,
    image varchar(255),
    content text not null,
    map_link varchar(1000),
    status enum('pending', 'published', 'rejected') default 'pending',
    approved_at timestamp null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,


    foreign key (category_id) references categories(id_category) on delete cascade,
    foreign key (user_id) references users(id_user) on delete set null,
    foreign key (approved_by) references users(id_user) on delete set null

);




INSERT INTO categories (cat_name) VALUES
     ('Beaches'),
    ('Food & Restaurants'),
    ('Culture & History'),
    ('Nature & Parks'),
    ('Hotels & Riads'),
    ('Nightlife')
ON DUPLICATE KEY UPDATE cat_name = VALUES(cat_name);



