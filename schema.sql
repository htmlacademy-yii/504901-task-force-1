CREATE DATABASE taskforce CHARACTER SET utf8 COLLATE utf8_general_ci;
use taskforce;

/* Зарегистрированные пользователи */
CREATE TABLE user
(
    id_user              INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email                VARCHAR(128) NOT NULL UNIQUE,
    password             VARCHAR(255) NOT NULL,
    name                 VARCHAR(50)  NOT NULL,
    date_of_registration TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

/* Города */
CREATE TABLE city
(
    id_city   INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name      VARCHAR(50) NOT NULL,
    latitude  FLOAT       NOT NULL,
    longitude FLOAT       NOT NULL
);

/* Роли */
CREATE TABLE role
(
    id_role INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(30)
);

/* Статусы */
CREATE TABLE status
(
    id_status   INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(30),
    translation VARCHAR(30)
);

/* Статус-роль */
CREATE TABLE status_role
(
    id_status INT NOT NULL,
    id_role   INT NOT NULL,
    FOREIGN KEY (id_status) REFERENCES status (id_status),
    FOREIGN KEY (id_role) REFERENCES role (id_role),
    PRIMARY KEY (id_status, id_role)
);

/* Профили */
CREATE TABLE profile
(
    id_user      INT        NOT NULL PRIMARY KEY,
    avatar       VARCHAR(255),
    birthday     DATE,
    id_role      INT        NOT NULL,
    about        TEXT,
    phone        CHAR(11),
    skype        VARCHAR(50),
    telegram     VARCHAR(50),
    id_city      INT        NOT NULL,
    address      VARCHAR(255),
    new_message  TINYINT(1) NOT NULL DEFAULT 1,
    actions      TINYINT(1) NOT NULL DEFAULT 1,
    new_review   TINYINT(1) NOT NULL DEFAULT 1,
    show_contact TINYINT(1) NOT NULL DEFAULT 0,
    show_profile TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (id_city) REFERENCES city (id_city),
    FOREIGN KEY (id_user) REFERENCES user (id_user),
    FOREIGN KEY (id_role) REFERENCES role (id_role)
);

/* Статистика */
CREATE TABLE statistic
(
    id_user     INT         NOT NULL PRIMARY KEY,
    rating      FLOAT(4, 2) NOT NULL DEFAULT 0,
    count_tasks INT         NOT NULL DEFAULT 0,
    count_views INT         NOT NULL DEFAULT 0,
    count_fail  INT         NOT NULL DEFAULT 0,
    FOREIGN KEY (id_user) REFERENCES profile (id_user)
);

/* Категории */
CREATE TABLE category
(
    id_category INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50) NOT NULL,
    icon        VARCHAR(50) NOT NULL
);

/* Специализации */
CREATE TABLE specialization
(
    id_user     INT NOT NULL,
    id_category INT NOT NULL,
    FOREIGN KEY (id_category) REFERENCES category (id_category),
    FOREIGN KEY (id_user) REFERENCES profile (id_user),
    PRIMARY KEY (id_user, id_category)
);

/* Избранное */
CREATE TABLE favorite
(
    id_customer INT NOT NULL,
    id_executor INT NOT NULL,
    FOREIGN KEY (id_customer) REFERENCES profile (id_user),
    FOREIGN KEY (id_executor) REFERENCES profile (id_user),
    PRIMARY KEY (id_customer, id_executor)
);

/* События */
CREATE TABLE event
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
    FOREIGN KEY (id_user) REFERENCES user (id_user),
    FOREIGN KEY (id_event) REFERENCES event (id_event)
);

/* Задания */
CREATE TABLE task
(
    id_task            INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_of_creation   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_status          INT          NOT NULL,
    name_task          VARCHAR(255) NOT NULL,
    id_city            INT   NOT NULL,
    address            VARCHAR(50),
    id_category        INT          NOT NULL,
    description        TEXT         NOT NULL,
    date_of_completion DATE,
    budget             INT,
    latitude           FLOAT,
    longitude          FLOAT,
    id_owner           INT          NOT NULL,
    FOREIGN KEY (id_status) REFERENCES status (id_status),
    FOREIGN KEY (id_owner) REFERENCES profile (id_user),
    FOREIGN KEY (id_city) REFERENCES city (id_city),
    FOREIGN KEY (id_category) REFERENCES category(id_category)
);

/* Исполнители заданий */
CREATE TABLE executor_task
(
    id_task             INT       NOT NULL PRIMARY KEY,
    date_of_appointment TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_executor         INT       NOT NULL,
    FOREIGN KEY (id_executor) REFERENCES profile (id_user)
);

/* Файлы */
CREATE TABLE file
(
    id_file INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_task INT NOT NULL,
    name    VARCHAR(255),
    FOREIGN KEY (id_task) REFERENCES task (id_task)
);

/* Отзывы */
CREATE TABLE review
(
    id_review INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_add  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    mark      TINYINT,
    comment   TEXT,
    id_task   INT       NOT NULL,
    FOREIGN KEY (id_task) REFERENCES task (id_task)
);

/* отклики */
CREATE TABLE response
(
    id_response INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_add    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cost        INT,
    id_task     INT       NOT NULL,
    id_user     INT       NOT NULL,
    mark        TINYINT(1),
    performed   TINYINT(1)         DEFAULT 0,
    message     TEXT,
    FOREIGN KEY (id_user) REFERENCES profile (id_user),
    FOREIGN KEY (id_task) REFERENCES task (id_task)
);

/* Уведомления */
CREATE TABLE notification
(
    id_notification INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_add        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_task         INT       NOT NULL,
    id_user         INT       NOT NULL,
    message         VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES profile (id_user),
    FOREIGN KEY (id_task) REFERENCES task (id_task)
);

/* Сообщения */
CREATE TABLE message
(
    id_message INT       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_add   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_user    INT       NOT NULL,
    message    VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES profile (id_user)
);
