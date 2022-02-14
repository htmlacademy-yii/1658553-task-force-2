CREATE DATABASE taskforce
  DEFAULT CHARACTER SET UTF8
  DEFAULT COLLATE utf8_general_ci;
USE taskforce;

CREATE TABLE cities
(
  id          int AUTO_INCREMENT PRIMARY KEY,
  name        varchar(24) NOT NULL,
  coordinates point       NOT NULL

);

CREATE TABLE categories
(
  id   int AUTO_INCREMENT PRIMARY KEY,
  name varchar(64) NOT NULL
);
CREATE TABLE files
(
  id   int AUTO_INCREMENT PRIMARY KEY,
  path varchar(1024) NOT NULL
);

CREATE TABLE users
(
  id               int AUTO_INCREMENT PRIMARY KEY,
  create_date      datetime     NOT NULL,
  email            varchar(128) NOT NULL,
  login            varchar(128) NOT NULL,
  password         varchar(64)  NOT NULL,
  avatar_file_id   int          NULL,
  contact_telegram varchar(24)  NULL,
  contact_phone    varchar(11)  NULL,
  city_id          int  NOT NULL,
  birthday         datetime     NULL,
  info             text         NULL,
  rating           int          NULL,
  status           int          NULL,
  is_executor      bool         NOT NULL,
  FOREIGN KEY (`city_id`) REFERENCES cities (`id`)

);

CREATE TABLE user_categories
(
  id          int AUTO_INCREMENT PRIMARY KEY,
  category_id int NOT NULL,
  user_id     int NOT NULL,
  FOREIGN KEY (`category_id`) REFERENCES categories (`id`),
  FOREIGN KEY (`user_id`) REFERENCES users (`id`)
);

CREATE TABLE tasks
(
  id               int AUTO_INCREMENT PRIMARY KEY,
  create_time      datetime     NOT NULL,
  deadline_time    datetime     NOT NULL,
  name             varchar(255) NOT NULL,
  info             text         NOT NULL,
  category_id      int          NOT NULL,
  city_id          int          NOT NULL,
  price            int          null NOT NULL,
  task_status_id   int          NOT NULL,
  task_customer_id int          NOT NULL,
  task_executor_id int          NULL,
  status           int          NOT NULL,
  FOREIGN KEY (`task_customer_id`) REFERENCES users (`id`),
  FOREIGN KEY (`task_executor_id`) REFERENCES users (`id`),
  FOREIGN KEY (`category_id`) REFERENCES categories (`id`),
  FOREIGN KEY (`city_id`) REFERENCES cities (`id`)
);

CREATE TABLE task_files
(
  id      int AUTO_INCREMENT PRIMARY KEY,
  task_id int NOT NULL,
  file_id int NOT NULL,
  FOREIGN KEY (`task_id`) REFERENCES tasks (`id`),
  FOREIGN KEY (`file_id`) REFERENCES files (`id`)

);

CREATE TABLE responses
(
  id          int AUTO_INCREMENT PRIMARY KEY,
  task_id     int      NOT NULL,
  executor_id int      NOT NULL,
  price       int      NOT NULL,
  comment     text     NOT NULL,
  rejected    bool DEFAULT FALSE,
  create_time datetime NOT NULL,
  FOREIGN KEY (`task_id`) REFERENCES tasks (`id`),
  FOREIGN KEY (`executor_id`) REFERENCES users (`id`)
);

CREATE TABLE reviews
(
  id          int AUTO_INCREMENT PRIMARY KEY,
  executor_id int      NOT NULL,
  custumer_id int      NOT NULL,
  task_id     int      NOT NULL,
  score       int      NOT NULL,
  comment     text     NOT NULL,
  create_time datetime NOT NULL

);

CREATE UNIQUE INDEX email ON users (email)

