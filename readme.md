# Ecomatic

Ecomatic is a Laravel-based e-commerce project that uses Docker to manage the application environment. The project consists of two main services:

- **App**: The Laravel 5.3 application running on PHP 7.0 FPM.
- **Web**: The Nginx web server serving the Laravel application.

## Prerequisites

Before you can get started, ensure that you have the following installed:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

To start the application, follow these steps:

1. **Clone the repository**:

   ```bash
   git clone https://github.com/your-username/ecomatic.git
   cd ecomatic

2. Build and run the containers:
    ```bash 
    2. docker-compose up --build

Access the application:

Once the containers are running, you can access the application in your browser:
   ```web
    http://localhost:8000
```

# Licence
This project is licensed under the MIT License. See the LICENSE file for details.