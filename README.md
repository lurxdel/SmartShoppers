<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions"><img src="https://img.shields.io/github/actions/workflow/status/laravel/framework/tests.yml?branch=10.x" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## SmartShoppers
A simple shopping system using **Laravel Blade Breeze.**

<p align="center">
  <img src="https://github.com/user-attachments/assets/bd38e463-ad6c-4150-84a4-a91ce6000cfc" width="200">
</p>

## Features

- **Authentication (Blade Breeze)**
  - Needs admin approval before logging in
  - **Role-based login:** Admin, Staff, User
 
- **Access Control**
  - **Admin View:** Full access and approval rights
  - **Staff View:** Partial access, update order status
  - **User View:** Purchase and view own orders
 
- **CRUD Functionality**
  - 2 Master Tables `(e.g., Products, Users)`
  - 1 Transaction Table `(e.g., Purchases)`
    
- **Search and Pagination**
  - Integrated search bar with paginated results
    
- **PDF Generation**
  - Export all data reports
  - Export `filtered` individual reports
    
- **UI Design**
  - Minimal, clean, and intuitive interface
 
## Guide To Run
To run the system locally, do the following.
> - **Clone this repository** or download it as a **ZIP file.**
> - When cloning the repository, follow these commands.

1. Install PHP dependencies, do this commands in terminal:
   ```bash
    composer install
    cp .env.example .env
    php artisan key:generate
   ```

3. Set the `.env` file to your own database configuration.
   ```bash
   DB_DATABASE=your_database_name //SET YOUR OWN DATABASE
   ```

4. Run migrations and build frontend, do this commands in terminal:
   ```bash
    php artisan migrate
    npm install
    npm run build
   ```

6. Link storage and seed the database, do this commands in terminal:
   ```bash
    php artisan storage:link
    php artisan db:seed
   ```

> **Note:** This will create datas on your database with default role accounts:
>   
>  | Role  | Email             | Password  |
>  |-------|-------------------|-----------|
>  | Admin | admin@email.com   | 12345678  |
>  | Staff | staff@email.com   | 12345678  |
>  | User  | user@email.com    | 12345678  |

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
