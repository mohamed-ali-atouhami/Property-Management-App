# Property Management Application

## Overview
This application is a simple property management system built with Laravel 10 . It allows property managers to manage properties, tenants, and rental payments, and includes features like automated due payment notifications and unit tests.

## Features
- **Property Management**: CRUD ,Filtring and Sorting.
- **Tenant Management**: Add, update, delete, and view tenants.
- **Rental Payments Monitoring**: Track payments and update their status.
- **Authentication :**: JWT (JSON Web Tokens) for basic authentication
- **Automated Email Notifications**: Sends automated email notifications for due payments (mocked process).
- **Unit Testing**: Includes unit tests for critical features.

## Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- Git

## Setup
1. **Clone the Repository :** 
   ```bash
   git clone https://github.com/mohamed-ali-atouhami/Property-Management-App.git
   cd <repository-directory>
    ```
2. **Install Dependencies :** 

    ```bash
    composer install
    ```
3. **Environment Setup :**

    3.1- **Copy .env.example to .env**
    ```bash
    copy .env.example .env
    ```
    3.2- **Update the .env file with your database**
    ```bash
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
4. **Generate Application Key :**
    ```bash
    php artisan key:generate
    ```
5. **Run Migrations :**
    ```bash
    php artisan migrate
    ```
6. **Run the Development Server :**
    ```bash
    php artisan serve
    ```
     Your application should now be running at http://localhost:8000.

## Testing
**Running Unit Test**
1. **Run the Tests :**

    ```bash
    php artisan test
    ```
This will execute the unit tests and display the results.

## API endpoints

#### Base URL
```http
http://localhost:8000
```
#### Authentication
- Most API endpoints are protected and require authentication using JWT (JSON Web Token). To access these endpoints, you need to include the Authorization header with a valid token.
#### Header Example:
```bash
Authorization: Bearer <your-jwt-token>
```
#### User Authentication :
- Register :
```http
URL: /api/register
Method: POST
```
#### Request Body :
```json
{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "password123",
}

```
- Login :
```http
URL: /api/login
Method: POST
```
#### Request Body :
```json
{
    "email": "johndoe@example.com",
    "password": "password123",
}

```
- Logout :
```http
URL: /api/logout
Method: POST
```
#### Headers :
```bash
Authorization: Bearer <your-jwt-token>

```
- Response: Success (200 OK):
```json
{
    "message": "Successfully logged out."
}

```
#### Get all properties

```http
  URL: /api/properties
  Method: GET
```
#### Headers :
```bash
Authorization: Bearer <your-jwt-token>

```
#### Query Parameters:
- Example Request:
```http
GET /api/properties?address=Main
```
this route is responsible for filtering properties by address
-
```http
GET /api/properties?type=house
```
and this use it to filter by type
- 
```http
GET /api/properties?min_rental_cost=1000&max_rental_cost=2000
```

Filtring by Rental price range
-
```http
GET /api/properties?sort_by=rental_cost&sort_order=desc
```

Sort by Rental Price
-
#### Create new property

```http
  URL: /api/properties
  Method: post
```
#### Request Body :
```json
{
    "name": "Elm Street House",
    "address": "456 Elm St",
    "type": "house",
    "rental_cost": 1500
}
```
#### update  property

```http
  URL: /api/properties/{id}
  Method: put
```
#### Request Body :
```json
{
    "name": "smth",
    "address": "***",
    "type": "apartment",
    "rental_cost": 1500
}
```
#### delete property

```http
  URL: /api/properties/{id}
  Method: delete
```
#### Response :
```json
{
     "message": "Property deleted successfully."
}
```
## The routes for Tenants and Payments 
```http
  URL: /api/tenants
  URL : /api/payments
```
#### Send automated email notifications for due payment
```http
  URL: /api/notifications/send-due-payments
  Method: post
```
#### Response :
```json
{
     "message": "  Due payment notifications sent successfully."
}
```