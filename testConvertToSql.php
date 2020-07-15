<?php
require_once('vendor/autoload.php');

use taskForce\classes\ConvertCsvToSql;
use taskForce\exception\FileFormatException;
use taskForce\exception\SourceFileException;

try {
    ConvertCsvToSql::createSql(__DIR__ . '/data/users.csv',
        ['email', 'name', 'password', 'date_of_registration'],
        'users');
    ConvertCsvToSql::createSql(__DIR__ . '/data/cities.csv',
        ['name', 'latitude', 'longitude'],
        'cities');
    ConvertCsvToSql::createSql(__DIR__ . '/data/roles.csv',
        ['name'],
        'roles');
    ConvertCsvToSql::createSql(__DIR__ . '/data/statuses.csv',
        ['name', 'translation'],
        'statuses');
    ConvertCsvToSql::createSql(__DIR__ . '/data/status_role.csv',
        ['id_status', 'id_role'],
        'status_role');
    ConvertCsvToSql::createSql(__DIR__ . '/data/profiles.csv',
        ['id_user', 'address', 'birthday', 'about', 'phone', 'skype', 'id_role', 'id_city'],
        'profiles');
    ConvertCsvToSql::createSql(__DIR__ . '/data/categories.csv',
        ['name', 'icon'],
        'categories');
    ConvertCsvToSql::createSql(__DIR__ . '/data/specializations.csv',
        ['id_user', 'id_category'],
        'specializations');
    ConvertCsvToSql::createSql(__DIR__ . '/data/tasks.csv',
        ['date_of_creation', 'id_category', 'description', 'date_of_completion', 'name_task', 'address', 'budget', 'latitude', 'longitude', 'id_owner', 'id_status'],
        'tasks');
    ConvertCsvToSql::createSql(__DIR__ . '/data/executor_tasks.csv',
        ['id_task', 'date_of_appointment', 'id_executor'],
        'executor_tasks');
    ConvertCsvToSql::createSql(__DIR__ . '/data/opinions.csv',
        ['date_add', 'mark', 'comment', 'id_task'],
        'reviews');
    ConvertCsvToSql::createSql(__DIR__ . '/data/replies.csv',
        ['date_add', 'mark', 'message', 'id_task', 'id_user'],
        'responses');
} catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $e->getMessage());
    print("Не удалось обработать csv файл: " . $e->getMessage());
} catch (FileFormatException $e) {
    error_log("Неверная форма файла импорта: " . $e->getMessage());
    print("Неверная форма файла импорта: " . $e->getMessage());
}


