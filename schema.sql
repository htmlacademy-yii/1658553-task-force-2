CREATE DATABASE taskforce
  DEFAULT CHARACTER SET UTF8
  DEFAULT COLLATE utf8_general_ci;
USE taskforce;

CREATE TABLE location
(
  id   int AUTO_INCREMENT PRIMARY KEY,
  city varchar(24)
);
CREATE TABLE categories
(
  id       int AUTO_INCREMENT PRIMARY KEY,
  category varchar(64)

);

CREATE TABLE user_status
(
  id     int AUTO_INCREMENT PRIMARY KEY,
  status varchar(244)

);
CREATE TABLE task_status
(
  id     int AUTO_INCREMENT PRIMARY KEY,
  status varchar(244)

);

CREATE TABLE user
(
  id               int AUTO_INCREMENT PRIMARY KEY,
  reg_date         datetime,
  email            varchar(128),
  login            varchar(128),
  password         varchar(64),
  avatar           text,
  contact_telegram varchar(24),
  contact_phone    varchar(11),
  contact_mail     varchar(24),
  location_id      int,
  info             text,
  rating           int,
  status_id        int,
  FOREIGN KEY (`location_id`) REFERENCES location (`id`),
  FOREIGN KEY (`status_id`) REFERENCES user_status (`id`)

);
CREATE TABLE user_specialization
(
  id                int AUTO_INCREMENT PRIMARY KEY,
  specialization_id int,
  user_id           int,
  FOREIGN KEY (`specialization_id`) REFERENCES categories (`id`),
  FOREIGN KEY (`user_id`) REFERENCES user (`id`)

);

CREATE TABLE task
(
  id               int AUTO_INCREMENT PRIMARY KEY,
  reg_date         datetime,
  execution_date   datetime,
  header           varchar(255),
  info             text,
  category_id      int,
  location_id      int,
  price            int,
  file             text,
  task_status_id   int,
  task_customer_id int,
  task_executor_id int,
  FOREIGN KEY (`task_customer_id`) REFERENCES user (`id`),
  FOREIGN KEY (`task_executor_id`) REFERENCES user (`id`),
  FOREIGN KEY (`task_status_id`) REFERENCES task_status (`id`),
  FOREIGN KEY (`category_id`) REFERENCES categories (`id`),
  FOREIGN KEY (`location_id`) REFERENCES location (`id`)

);

