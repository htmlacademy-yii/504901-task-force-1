CREATE DATABASE task_force CHARACTER SET utf8 COLLATE utf8_general_ci;
use task_force;

/* Зарегистрированные пользователи */
CREATE TABLE users
(
    id_user              INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email                VARCHAR(128) NOT NULL UNIQUE,
    password             VARCHAR(255) NOT NULL,
    name                 VARCHAR(50)  NOT NULL,
    date_of_registration TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

/* Города */
CREATE TABLE cities
(
    id_city   INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name      VARCHAR(50) NOT NULL,
    latitude  FLOAT       NOT NULL,
    longitude FLOAT       NOT NULL
);

/* Роли */
CREATE TABLE roles
(
    id_role INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(30)
);

/* Статусы */
CREATE TABLE statuses
(
    id_status INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name      VARCHAR(30)
);

/* Статус-роль */
CREATE TABLE status_role
(
    id_status INT NOT NULL,
    id_role   INT NOT NULL,
    FOREIGN KEY (id_status) REFERENCES statuses (id_status),
    FOREIGN KEY (id_role) REFERENCES roles (id_role),
    PRIMARY KEY (id_status, id_role)
);

/* Профили */
CREATE TABLE profiles
(
    id_user      INT         NOT NULL PRIMARY KEY,
    avatar       VARCHAR(255),
    birthday     DATE,
    id_role      INT         NOT NULL,
    about        TEXT,
    phone        CHAR(11),
    skype        VARCHAR(50),
    telegram     VARCHAR(50),
    id_city      INT         NOT NULL,
    new_message  TINYINT(1)  NOT NULL DEFAULT 1,
    actions      TINYINT(1)  NOT NULL DEFAULT 1,
    new_review   TINYINT(1)  NOT NULL DEFAULT 1,
    show_contact TINYINT(1)  NOT NULL DEFAULT 0,
    show_profile TINYINT(1)  NOT NULL DEFAULT 0,
    FOREIGN KEY (id_city) REFERENCES cities (id_city),
    FOREIGN KEY (id_user) REFERENCES users (id_user),
    FOREIGN KEY (id_role) REFERENCES roles (id_role)
);

/* Статистика */
CREATE TABLE statistics
(
    id_user     INT         NOT NULL PRIMARY KEY,
    rating      FLOAT(4, 2) NOT NULL DEFAULT 0,
    count_tasks INT         NOT NULL DEFAULT 0,
    count_views INT         NOT NULL DEFAULT 0,
    count_fail  INT         NOT NULL DEFAULT 0,
    FOREIGN KEY (id_user) REFERENCES profiles (id_user)
);

/* Категории */
CREATE TABLE categories
(
    id_category INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50) NOT NULL,
    icon        VARCHAR(50) NOT NULL
);

/* Специализации */
CREATE TABLE specializations
(
    id_user     INT NOT NULL,
    id_category INT NOT NULL,
    FOREIGN KEY (id_category) REFERENCES categories (id_category),
    FOREIGN KEY (id_user) REFERENCES profiles (id_user),
    PRIMARY KEY (id_user, id_category)
);

/* Избранное */
CREATE TABLE favorites
(
    id_customer INT NOT NULL,
    id_executor INT NOT NULL,
    FOREIGN KEY (id_customer) REFERENCES profiles (id_user),
    FOREIGN KEY (id_executor) REFERENCES profiles (id_user),
    PRIMARY KEY (id_customer, id_executor)
);

/* События */
CREATE TABLE events
(
    id_event INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(50) NOT NULL
);

/* Активность пользователя */
CREATE TABLE user_activity
(
    id_activity   INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user       INT       NOT NULL,
    id_event      INT       NOT NULL,
    date_activity TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users (id_user),
    FOREIGN KEY (id_event) REFERENCES events (id_event)
);

/* Задания */
CREATE TABLE tasks
(
    id_task            INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_of_creation   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_status          INT          NOT NULL,
    name_task          VARCHAR(255) NOT NULL,
    address            VARCHAR(50),
    id_category        INT          NOT NULL,
    description        TEXT         NOT NULL,
    date_of_completion DATE,
    budget             INT,
    id_owner           INT          NOT NULL,
    FOREIGN KEY (id_status) REFERENCES statuses (id_status),
    FOREIGN KEY (id_owner) REFERENCES profiles (id_user)
);

/* Исполнители заданий */
CREATE TABLE executor_tasks
(
    id_task             INT       NOT NULL PRIMARY KEY,
    date_of_appointment TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_executor         INT       NOT NULL,
    FOREIGN KEY (id_executor) REFERENCES profiles (id_user)
);

/* Локации */
CREATE TABLE locations
(
    id_city   INT   NOT NULL,
    id_task   INT   NOT NULL,
    latitude  FLOAT NOT NULL,
    longitude FLOAT NOT NULL,
    FOREIGN KEY (id_city) REFERENCES cities (id_city),
    FOREIGN KEY (id_task) REFERENCES tasks (id_task),
    PRIMARY KEY (id_city, id_task)
);

/* Файлы */
CREATE TABLE files
(
    id_file INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_task INT NOT NULL,
    name    VARCHAR(255),
    FOREIGN KEY (id_task) REFERENCES tasks (id_task)
);

/* Отзывы */
CREATE TABLE reviews
(
    id_review INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_add  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    mark      TINYINT,
    comment   TEXT,
    id_task   INT       NOT NULL,
    FOREIGN KEY (id_task) REFERENCES tasks (id_task)
);

/* отклики */
CREATE TABLE responses
(
    id_response INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_add    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cost        INT,
    id_task     INT       NOT NULL,
    id_user     INT       NOT NULL,
    mark        TINYINT(1),
    performed   TINYINT(1)         DEFAULT 0,
    message     VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES profiles (id_user),
    FOREIGN KEY (id_task) REFERENCES tasks (id_task)
);

/* Уведомления */
CREATE TABLE notifications
(
    id_notification INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_add        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_task         INT       NOT NULL,
    id_user         INT       NOT NULL,
    message         VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES profiles (id_user),
    FOREIGN KEY (id_task) REFERENCES tasks (id_task)
);

/* Сообщения */
CREATE TABLE messages
(
    id_message INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_add   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_user    INT       NOT NULL,
    message    VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES profiles (id_user)
);
