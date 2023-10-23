
# Chat Interface Project Documentation

## Table of Contents

1. [Introduction](#1-introduction)
2. [Project Setup](#2-project-setup)
 - [Prerequisites](#21-prerequisites)
 - [Installation](#22-installation)
 - [Configuration](#23-configuration)
3. [Usage](#3-usage)
 - [Running the Application](#31-running-the-application)
 - [Accessing the Chat Interface](#32-accessing-the-chat-interface)
4. [Features](#4-features)
5. [Authentication](#5-authentication)
6. [Chat Interface](#6-chat-interface)
7. [Tech Stack](#7-tech-stack)
8. [Database](#8-database)
9. [Environment Variables](#9-environment-variables)
10. [Running Tests with PHPUnit](#10-running-tests-with-phpunit)
11. [License](#11-license)
12. [Deployment](#12-deployment)

## 1. Introduction

This project, named "Chat Interface," is a Laravel-based application that leverages Inertia, React, and Tailwind CSS to create a chat interface similar to Chat-GPT. It provides user authentication through Laravel Breeze, and it relies on a MySQL database for data storage. Additionally, it requires specific environment variables, including `OPENAI_API_KEY`in your `.env` file.

## 2. Project Setup

### 2.1 Prerequisites

Before setting up the project, make sure you have the following prerequisites:

- PHP (>=8.0)
- Composer
- Node.js (>=18.0)
- NPM or Yarn
- MySQL
- An OpenAI GPT-3 API Key (Sign up at [OpenAI](https://beta.openai.com/) to get your API key)
- Laravel Breeze and Laravel Jetstream for authentication and frontend scaffolding

### 2.2 Installation

Follow these steps to set up the project:

1. Clone the project repository from GitHub:

   ```bash
   git clone https://github.com/your-username/chat-interface.git`` 

2.  Navigate to the project directory:
    
    bashCopy code
    
    `cd chat-interface` 
    
3.  Install PHP dependencies:
    
    bashCopy code
    
    `composer install` 
    
4.  Install JavaScript dependencies:
    
    bashCopy code
    
    `npm install
    # OR
    yarn` 
    
5.  Create a copy of the `.env` file:
    
    bashCopy code
    
    `cp .env.example .env` 
    
6.  Generate a new application key:
    
    bashCopy code
    
    `php artisan key:generate` 
    
7.  Configure your database settings in the `.env` file:
    
    makefileCopy code
    
    `DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password` 
    

### 2.3 Configuration

To configure the OpenAI API and other environment variables, edit your `.env` file:

makefileCopy code

`OPENAI_API_KEY=your_openai_api_key` 

## 3. Usage

### 3.1 Running the Application

You can run the application using the following commands:

bashCopy code

`# Compile assets
npm run dev
# OR
yarn dev

# Start the Laravel development server
php artisan serve` 

### 3.2 Accessing the Chat Interface

Open your web browser and navigate to `http://localhost:8000` to access the Chat Interface.

## 4. Features

-   **Chat Interface:** A chat application that mimics the Chat-GPT experience.
-   **User Authentication:** User authentication using Laravel Breeze.
-   **Real-time Messaging:** Real-time messaging for a seamless chat experience.
-   **Chat History:** Viewing and scrolling through chat history.
-   **Customizable Interface:** Tailwind CSS makes it easy to customize the app's appearance.

## 5. Authentication

The project uses Laravel Breeze for user authentication. You can log in or register using the provided forms.

## 6. Chat Interface

The chat interface lets you engage in a conversation with an AI-powered chatbot, similar to OpenAI's GPT-3. You can send messages and receive responses in real-time.

## 7. Tech Stack

-   Laravel (PHP)
-   Inertia.js
-   React
-   Tailwind CSS
-   MySQL

## 8. Database

The project uses a MySQL database for storing chat messages, user information, and session data.

## 9. Environment Variables

Make sure to configure the following environment variables in your `.env` file:

-   `OPENAI_API_KEY`: Your OpenAI GPT-3 API Key.

## 10. Running Tests with PHPUnit

The project includes a testing suite powered by PHPUnit, a widely-used testing framework for PHP. To run tests, execute the following command:

bashCopy code

`php artisan test` 

To write new tests, create test methods within test files and use PHPUnit's assertion methods. Test files are located in the `tests/` directory.

## 11. License

This project is distributed under the [Specify the project's license (e.g., MIT, GPL)] license. See the project's LICENSE file for details.

kotlinCopy code

 ## 12. Deployment

The application has been deployed on a Digital Ocean server. Follow the steps below to access the application:

1. **Access URL**: You can access the application through the following URL: [http://67.207.93.154/](http://67.207.93.154/)

This URL will provide access to the Chat Interface online. Please make sure to keep the server and application up and running for the evaluators to access it as needed.

Remember to monitor the server and perform security updates as necessary. Also, keep your credentials and sensitive information in a secure location and do not share them publicly.

If you have any further questions or need additional assistance, please feel free to contact [kelvinsilvadev@gmail.com](mailto:kelvinsilvadev@gmail.com).
