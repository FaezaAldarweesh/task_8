## blade CRUD System

This repository contains a blade CRUD System built with Laravel, with daily reports.

## Installation
- git clone https://github.com/FaezaAldarweesh/task_7.git
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve

  ## Cron Job steps:
  - php artisan make command DailyMail
  - function handle : get all Task Pending then dispatch MailSend (job to send email to all users)
  - deffiend app->console->kernel to schedule command to run it daily
  - php artisan serv
  - php artisan queue:work
  - php artisan schedule:run
