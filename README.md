## Installation Instructions

- Extract the project zip file
- Change the ownership of the Laravel directory to the webserver user and also the permissions:
    - sudo chown -R www-data:www-data /home/ubuntu/rhel-patch-dashboard
    - sudo chmod -R 775 /home/ubuntu/rhel-patch-dashboard/storage

- Create a MySQL database for the project
    - mysql -u root -p
    - create database rhel;
    - \q
- Copy .env.example to .env
- Configure your .env file
    - DB_DATABASE=rhel
    - DB_USERNAME=root
    - DB_PASSWORD=
- Run 'composer install' from the projects root folder.
- From the projects root folder run 'php artisan key:generate'
- From the projects root folder run 'php artisan migrate --seed'
- Run 'php artisan serve'
- Start server at http://localhost:8000
- Login to dashboard with the below credentials
    - Email: ```admin@admin.com```
    - Password: ```123456```