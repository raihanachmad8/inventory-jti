# PHP MVC INVENTARIS JTI

Welcome to Project INVENTARIS JTI!

This repository hosts a comprehensive inventory management solution specially designed for the JTI department. The system facilitates the tracking and management of borrowed items, ensuring efficient handling of inventory resources. Whether it's equipment, tools, or other assets, the system aims to streamline the process of lending and returning items within the JTI organization.

## Features

- **Item Tracking:** Easily track and manage the availability of various items within the inventory.
- **Loan Management:** Efficiently handle the process of loaning items to users and tracking return dates.
- **User Management:** Maintain a database of users, allowing for a seamless association of borrowed items.
- **Reports and Analytics:** Generate reports and gain insights into inventory usage, helping in decision-making.


## Authors

- [Achmad Raihan Fahrezi Effendy](https://www.github.com/raihanachmad8)




## Getting Started
This documentation provides information on setting up and running a PHP MVC project with MySQL.\
To get started with this project, follow the steps below to install the required dependencies.

## Table of Contents

- [PHP MVC INVENTARIS JTI](#php-mvc-inventaris-jti)
  - [Features](#features)
  - [Authors](#authors)
  - [Getting Started](#getting-started)
  - [Table of Contents](#table-of-contents)
    - [Prerequisites](#prerequisites)
  - [Install Repository](#install-repository)
  - [Usage](#usage)
  - [Documentation](#documentation)
  - [Contributing](#contributing)
    - [How to Contribute](#how-to-contribute)

### Prerequisites
- [XAMPP](https://www.apachefriends.org/index.html) (or any other PHP development environment)
- PHP - automatically include when install xampp
- MySQL - - automatically include when install xampp
- [Visual Studio Code (VSCode)](https://code.visualstudio.com/) (or Sublime Text, your text editor of choice)


## Install Repository

Clone Reposiory
```bash
git clone https://github.com/raihanachmad8/inventory-jti
```

## Usage

 Navigate to the project directory
```bash
cd inventory-jti
```

To run the project, you can use PHP's built-in server or set up an Apache server:

```bash
# start using Apache server
# [Add instructions for setting up Apache]

# Or Using PHP's built-in server
php -S localhost:80
```

Open xampp and run mysql server. Make sure your MySQL server is up and running.

Set up the .env file:

Copy the .env.example file to .env and configure the database connection details
```bash
cp .env.example .env
```
Update the .env file with your MySQL database credentials
```bash
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
save the changes

## Documentation
For detailed information on configuration and usage, refer to the project documentation.


## Contributing

We appreciate contributions from the community! The following individuals have contributed to the JTI Inventory Management System:

- [Vunky Himawan](https://github.com/vunky-himawan)
- [Dela Farahita Zain](https://www.github.com/delafarahita)
- [Putra Zakaria Muzaki](https://github.com/PutraZakaria)

### How to Contribute

Contributions are welcome! If you have ideas for improvements or find issues, please feel free to contribute by following these guidelines:

1. Fork the repository.
2. Create a new branch: `git checkout -b feature-branch`
3. Make your changes and commit: `git commit -m 'Add new feature'`
4. Push to the branch: `git push origin feature-branch`
5. Submit a pull request.

Please follow our [Contribution Guidelines](CONTRIBUTING.md) for more details.

Thank you for choosing the JTI Inventory Management System!
