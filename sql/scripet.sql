

-- create database
create database if not exists tangier_blog;

use tangier_blog;


-- users table
create table if not exists users (
    id_user int auto_increment primary key,
    user_name varchar(100) not null,
    email varchar(150) not null unique,
    password varchar(255) not null,
    role enum('user', 'admin') default 'user',
    created_at timestamp default current_timestamp
);


-- categories table
create table if not exists categories (
    id_category int auto_increment primary key,
    cat_name varchar(100) not null unique,
    created_at timestamp default current_timestamp
);


-- posts table
create table if not exists posts (
    id_post int auto_increment primary key,
    id_category int not null,
    id_user int null,
    id_approved_by int null,
    title varchar(255) not null,
    image varchar(255),
    content text not null,
    status enum('draft', 'pending', 'published', 'rejected') default 'pending',
    rejection_reason text null,
    approved_at timestamp null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,

    foreign key (id_category) references categories(id_category) on delete cascade,
    foreign key (id_user) references users(id_user) on delete set null,
    foreign key (id_approved_by) references users(id_user) on delete set null
);


-- default categories
insert into categories (cat_name) values
    ('Beaches'),
    ('Food & Restaurants'),
    ('Culture & History'),
    ('Nature & Parks'),
    ('Hotels & Riads'),
    ('Nightlife')
on duplicate key update cat_name = values(cat_name);


-- demo posts
insert into posts (
    id_category,
    id_user,
    id_approved_by,
    title,
    image,
    content,
    status,
    approved_at
) values
    (1, null, null, 'Achakkar Beach', '../assets/images/home.jpg', 'Achakkar Beach is one of the most beautiful coastal spots near Tangier, known for its wide sandy shore, ocean views, and sunset atmosphere.', 'published', now()),
    (2, null, null, 'Best Moroccan Breakfast in Tangier', '../assets/images/home.jpg', 'Tangier has many cozy cafes where visitors can enjoy msemen, harcha, mint tea, olives, honey, and traditional Moroccan flavors.', 'published', now()),
    (3, null, null, 'Kasbah Museum', '../assets/images/home.jpg', 'The Kasbah Museum is a cultural place in Tangier that presents the history, architecture, and artistic heritage of the city.', 'published', now()),
    (4, null, null, 'Perdicaris Park', '../assets/images/home.jpg', 'Perdicaris Park is a peaceful green area in Tangier, perfect for walking, relaxing, and enjoying nature close to the sea.', 'published', now()),
    (5, null, null, 'A Charming Riad Stay', '../assets/images/home.jpg', 'Traditional riads in Tangier offer calm rooms, Moroccan decoration, and a warm atmosphere close to the old medina.', 'published', now()),
    (6, null, null, 'Tangier Night Walk', '../assets/images/home.jpg', 'Tangier at night has a special charm, with lively streets, sea air, cafes, and city lights around the corniche and old town.', 'published', now());
