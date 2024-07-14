## About Laravel Wisata Backend

Laravel Wisata Backend is a web application and API for a Flutter application that developed for course [FIC Batch 17 Fullstack Flutter Laravel – Membangun Aplikasi POS Ticketing Wisata Offline Online dengan Cash & QRIS Payment](https://jagoflutter.com/courses/fic-batch17/)


### Technology used

<ul>
    <li>
        <a href="https://laragon.org/download/index.html" target="_blank">Laragon 6.0.0</a>.
    </li>
    <li>
        <a href="https://www.php.net/" target="_blank">PHP 8.3.9</a>.
    </li>
    <li>
        <a href="https://getcomposer.org/download/" target="_blank">Composer 2.7.7</a>.
    </li>
    <li>
        <a href="https://downloads.mysql.com/archives/community/" target="_blank">MySQL 8.0.30</a>.
    </li>
     <li>
        <a href="https://www.apachelounge.com/download/" target="_blank">Apache 2.4.61</a>.
    </li>
    <li>
        <a href="https://laravel.com/docs/11.x/" target="_blank">Laravel 11.15.0</a>.
    </li>
    <li>
        <a href="https://laravel.com/docs/11.x/fortify" target="_blank">Laravel Fortify 1.21.5</a> for login and logout.
    </li>
</ul>

## Demo

<table>
    <thead>
        <tr>
            <th>Email</th>
            <th>Password</th>
            <th>Name</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><b>admin@example.com<b></td>
            <td>12345678</td>
            <td>Test Admin</td>
            <td>admin</td>
        </tr>
        <tr>
            <td><b>staff@example.com</b></td>
            <td>12345678</td>
            <td>Test Staff</td>
            <td>staff</td>
        </tr>
        <tr>
            <td><b>user@example.com</b></td>
            <td>12345678</td>
            <td>Test User</td>
            <td>user</td>
        </tr>
    </tbody>
</table>

## Installation

Create a new project folder, cd into the folder

`git clone https://github.com/FadhilPrawira/laravel-wisata-backend-fadhilprawira.git`

`cd laravel-wisata-backend-fadhilprawira`

Copy the .env.example file to .env

`cp .env.example .env`

Make the needed changes regarding database connection, faker locale, timezone. By default it use timezone in Asia/Jakarta (UTC+7).

`composer install`

`php artisan key:generate`

`php artisan storage:link`

`php artisan migrate`

`php artisan db:seed`

To run, use `php artisan serve` or `php artisan serve --host=YOUR_IP_ADDRESS --port=YOUR_PORT_NUMBER`

Access the website in your browser at `http://localhost:8000` or `http://YOUR_IP_ADDRESS:YOUR_PORT_NUMBER`

## API Documentation
Look at folder `docs` for API documentation in Postman Collection v2.1 format.



## TODO
- Define every role permission
- Add Laravel Spatie for role permission/authorization
- Make sure column name in Laravel same as in Flutter SQLite
- Throw column name that ambiguous in Laravel and Flutter SQLite


## Contact me

<a href="https://www.linkedin.com/in/fadhilprawira/"><img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white" /></a> 

<a href="https://github.com/FadhilPrawira/"><img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" /></a>
