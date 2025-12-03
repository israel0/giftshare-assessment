# 🎁 GiftShare Community

A platform where registered users can post items they’re giving away for free. Other users can browse, vote, and comment on listings.
### ✨ Tech Stack

The application is built using the following technologies:
* **Backend Framework:** Laravel 12
* **Frontend Framework:** Livewire
* **Styling:** Bootstrap 5
* **Database:** MariaDB

---

## 📋 Table of Contents

* [Features](#features)
* [Screenshots/Demo](#screenshotsdemo)
* [Installation](#installation)
* [Usage](#usage)
* [Database Schema](#database-schema)
* [Key Livewire Components](#key-livewire-components)
* [Contributing](#contributing)
* [License](#license)

---

## ✅ Features

The GiftShare platform includes the following core functionalities:

* **Item Sharing:** Users can easily **post items** they want to share with the community.
* **Advanced Browsing:** Users can **browse items** by **category**, **city**, and **status** (Available / Gifted).
* **Filtering & Sorting:** Comprehensive filtering options including **search**, and sorting by **newest**, **oldest**, **most upvoted**, and **most commented**.
* **Community Tracking:** Track community giving progress with **statistics** and **progress bars**.
* **User Authentication:** Secure **user authentication** is required for posting items.
* **Responsive Design:** Fully responsive layout using **Bootstrap 5** for seamless use on any device.


## 💻 Installation

Follow these steps to set up the project locally.

### Prerequisites

Ensure you have the following installed:
* PHP (v8.1+)
* Composer
* Node.js & npm
* MySQL/MariaDB

### Step-by-Step Guide

1.  **Clone the Repository**

    ```bash
    git clone [https://github.com/israel0/giftshare-assessment.git](https://github.com/israel0/giftshare-assessment.git)
    cd giftshare-assessment
    ```

2.  **Install Dependencies**

    Install PHP dependencies via Composer and frontend dependencies via npm.

    ```bash
    composer install
    npm install
    npm run build
    ```

3.  **Setup Environment File**

    Copy the example environment file and generate a unique application key.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configure Database**

    Open the newly created `.env` file and update the database configuration to match your local setup.

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=giftshare
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Run Migrations and Seeders**

    Execute the migrations to create the necessary tables and seed the database with initial data.

    ```bash
    php artisan migrate --seed
    ```

6.  **Create Storage Link**

    Create a symbolic link for the storage directory to make publicly uploaded files accessible.

    ```bash
    php artisan storage:link
    ```

7.  **Start the Server**

    Start the Laravel development server. The application will typically be available at `http://127.0.0.1:8000`.

    ```bash
    php artisan serve
    ```

---

## 🚀 Usage

Once the application is running:

1.  Navigate to the application URL (e.g., `http://127.0.0.1:8000`).
2.  **Register** a new user account to gain access to posting features.
3.  Browse the **homepage** to view recently shared items.
4.  Use the **filters** to refine the listings by category or city.

---

## 📊 Database Schema

The core functionality revolves around key tables such as `users`, `listings`, `listingphotos`, `votes`, and `categories`.

