# This is a task project for Hamkoo ICT LTD.

The objective is to create a custom Laravel Application that seamlessly integrates OpenAI's ChatGPT API. This application will enable authenticated users of a Laravel application to interact with ChatGPT and save the results to a database. It serves as an assessment of the applicant's ability to develop a comprehensive Laravel application from scratch while ensuring user authentication and secure API communication.

## Follow the step to run this project to your localhost

-   clone / download this project

```
git clone
```

-   copy .env.example file

```
cp .env.example .env
```

-   generate laravel app key

```
php artisan key:generate
```

-   input database configeration at .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

-   Run migration for database

```
php artisan migrate
```

-   Run Laravel Project

```
php artisan serve
```

-   Run node package

```
npm install

npm run dev
```
