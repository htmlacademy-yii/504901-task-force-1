CREATE DATABASE taskforce CHARACTER SET utf8 COLLATE utf8_general_ci;
use taskforce;

/* Города */
CREATE TABLE city
(
    id        INT AUTO_INCREMENT PRIMARY KEY,
    name      VARCHAR(50) NOT NULL,
    latitude  FLOAT       NOT NULL,
    longitude FLOAT       NOT NULL
);

/* Зарегистрированные пользователи */
CREATE TABLE user
(
    id                   INT AUTO_INCREMENT PRIMARY KEY,
    email                VARCHAR(128) NOT NULL UNIQUE,
    password             VARCHAR(255) NOT NULL,
    name                 VARCHAR(50)  NOT NULL,
    date_of_registration TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    avatar       VARCHAR(255),
    birthday     DATE,
    about        TEXT,
    phone        CHAR(11),
    skype        VARCHAR(50),
    telegram     VARCHAR(50),
    city_id      INT NOT NULL,
    new_message  TINYINT(1) NOT NULL DEFAULT 1,
    actions      TINYINT(1) NOT NULL DEFAULT 1,
    new_review   TINYINT(1) NOT NULL DEFAULT 1,
    show_contact TINYINT(1) NOT NULL DEFAULT 0,
    show_profile TINYINT(1) NOT NULL DEFAULT 0,
    rating       FLOAT(4, 2) NOT NULL DEFAULT 0,
    count_tasks  INT NOT NULL DEFAULT 0,
    count_views  INT NOT NULL DEFAULT 0,
    count_fail   INT NOT NULL DEFAULT 0,
    date_activity TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (city_id) REFERENCES city (id)
);

/* Статусы */
CREATE TABLE status
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(30),
    translation VARCHAR(30)
);

/* Категории */
CREATE TABLE category
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50) NOT NULL,
    icon        VARCHAR(50) NOT NULL
);

/* Специализации */
CREATE TABLE specialization
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category (id),
    FOREIGN KEY (user_id) REFERENCES user (id)
);

/* Задания */
CREATE TABLE task
(
    id                 INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_of_creation   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status_id          INT          NOT NULL,
    name_task          VARCHAR(255) NOT NULL,
    category_id        INT NOT NULL,
    description        TEXT NOT NULL,
    date_of_completion DATE,
    budget             INT,
    owner_id           INT NOT NULL,
    FOREIGN KEY (status_id) REFERENCES status (id),
    FOREIGN KEY (owner_id) REFERENCES user (id),
    FOREIGN KEY (category_id) REFERENCES category(id)
);

/* Исполнители заданий */
CREATE TABLE executor_task
(
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    task_id             INT NOT NULL,
    date_of_appointment TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    executor_id         INT       NOT NULL,
    status_id           INT       NOT NULL,
    FOREIGN KEY (executor_id) REFERENCES user (id),
    FOREIGN KEY (status_id) REFERENCES status (id),
    FOREIGN KEY (task_id) REFERENCES task (id)
);

/* Файлы */
CREATE TABLE file
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT NOT NULL,
    name    VARCHAR(255),
    FOREIGN KEY (task_id) REFERENCES task (id)
);

/* Отзывы */
CREATE TABLE review
(
    id        INT AUTO_INCREMENT PRIMARY KEY,
    date_add  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    mark      TINYINT,
    comment   TEXT,
    task_id   INT  NOT NULL,
    FOREIGN KEY (task_id) REFERENCES task (id)
); 

/* отклики */
CREATE TABLE response
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    date_add    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cost        INT,
    task_id     INT       NOT NULL,
    user_id     INT       NOT NULL,
    canceled    TINYINT(1) DEFAULT 0,
    message     TEXT,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (task_id) REFERENCES task (id)
);
