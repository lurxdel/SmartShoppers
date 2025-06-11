<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## SmartShoppers
A simple shopping system using **Laravel Blade Breeze.**

## Features  

1. **CRUD**
   - **Tables**
     - 2 Masters Table
     - 1 Transaction Table
2. **Login (BLADE)**
   - Login Approval (Admin)
3. **Pagination and Search Modules**
4. **PDF**
   - Individual Report (Filtered)
   - All Report
5. **Restriction Level**
   - Admin View
   - Staff View
   - User View
6. **Simple UI**
 
## Guide To Run
To run the system locally, do the following.
> - **Clone this repository** or download it as a **ZIP file.**
> - When cloning the repository, run these commands.

1. First, do the following commands:
   > In your terminal:
    ```bash
    composer install
    cp .env.example .env
    php artisan key:generate
    ```

2. Change the DB_DATABASE in `.env` file to your own created database.

3. After that, do these commands:
   > In your terminal:
    ```bash
    php artisan migrate
    npm install
    npm run build
    ```

4. To access the system, do the following commands.
   > In your terminal:
    ```bash
    php artisan storage:link
    php artisan db:seed
    ```
> - **Note:** This will create a user data with roles in your database, to login use this.
>    - **ADMIN:** admin@email.com 12345678
>    - **STAFF:** staff@email.com 12345678
>    - **USER:** user@email.com 12345678

### Acknowledgment  
We are grateful to our instructors for their guidance and support throughout the development of this project. This work reflects our learning journey and the collaborative efforts of the team.  

## Support Me
If you like my work or find it helpful, you can support me by:

![Give Star](https://img.shields.io/badge/Give%20⭐️-F7DF1E?style=for-the-badge&logo=github&logoColor=black)
![Follow](https://img.shields.io/badge/Follow-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white)
![Collaborate](https://img.shields.io/badge/Collaborate-6CC24A?style=for-the-badge&logo=githubactions&logoColor=white)

## Disclaimer  
I do not own the images, names, or any other content used in this project.  

All trademarks, service marks, trade names, and other intellectual property rights belong to their respective owners.  
