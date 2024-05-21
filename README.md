## About Laravel Wisata Backend

Laravel Wisata Backend is a web application and API for a Flutter application that developed for course [FIC Batch 17 Fullstack Flutter Laravel – Membangun Aplikasi POS Ticketing Wisata Offline Online dengan Cash & QRIS Payment](https://jagoflutter.com/courses/fic-batch17/)


### Technology used

<ul>
    <li>
        <a href="https://laragon.org/download/index.html" target="_blank">Laragon 6.0.0</a>.
    </li>
    <li>
        <a href="https://www.php.net/" target="_blank">PHP 8.3.7</a>.
    </li>
    <li>
        <a href="https://downloads.mysql.com/archives/community/" target="_blank">MySQL 8.0.30</a>.
    </li>
     <li>
        <a href="https://www.apachelounge.com/download/" target="_blank">Apache 2.4.59</a>.
    </li>
    <li>
        <a href="https://laravel.com/docs/11.x/" target="_blank">Laravel 11.7.0</a>.
    </li>
    <li>
        <a href="https://laravel.com/docs/11.x/fortify" target="_blank">Laravel Fortify 1.21</a> for login and logout.
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
            <td><b>testadmin@example.com<b></td>
            <td>12345678</td>
            <td>Test Admin</td>
            <td>admin</td>
        </tr>
        <tr>
            <td><b>teststaff@example.com</b></td>
            <td>12345678</td>
            <td>Test Staff</td>
            <td>staff</td>
        </tr>
        <tr>
            <td><b>testuser@example.com</b></td>
            <td>12345678</td>
            <td>Test User</td>
            <td>user</td>
        </tr>
    </tbody>
</table>

## Installation

Create a new project folder, cd into the folder

`git clone https://github.com/FadhilPrawira/laravel-wisata-backend-fadhilprawira.git .`

`cp .env.example .env`

Make the needed changes regarding database connection, faker locale, timezone. By default it use timezone in Asia/Jakarta (UTC+7).

`composer install`

`php artisan key:generate`

`php artisan storage:link`

`php artisan migrate`

`php artisan db:seed`

To run, use `php artisan serve`


## Contact me

<a href="https://www.linkedin.com/in/fadhilprawira/"><img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white" /></a> 

<a href="https://github.com/FadhilPrawira/"><img src="https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white" /></a>
