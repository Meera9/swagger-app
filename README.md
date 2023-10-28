# Laravel L5-Swagger Example

This is an example Laravel application that demonstrates how to use L5-Swagger to generate API documentation, attach custom headers to your API, and set up multiple routes for your documentation.

## Installation

Follow these steps to set up the Laravel application with L5-Swagger:

1. Clone the repository:
   ```bash
   git clone https://github.com/Meera9/swagger-app.git
   cd your-repo

2. Install the composer dependencies:
   ```bash
   composer install

3. Create a .env file:
   ```bash   
   cp .env.example .env

4. Generate an application key:
   ```bash
   php artisan key:generate


5. Configure your database in the .env file:
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password


6. Migrate and seed the database:
   ```bash
   php artisan migrate --seed

7. Publish the L5-Swagger configuration:
   ```bash
   php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

   php artisan l5-swagger:generate (you can change here default to admin ---> config/l5-swagger.php file)

8. Open your .env file and update the Swagger settings:
   ```bash
   L5_SWAGGER_GENERATE_ALWAYS=true

9. Start the Laravel development server:
   ```bash
   php artisan serve

### Multiple Route Setup
This example includes multiple routes to demonstrate the flexibility of L5-Swagger in documenting your API. You can define your routes in the routes/api.php file. The Swagger documentation will automatically update to include these routes.

### Multiple Documentation
This example includes multiple documentation to showcase different aspects of your API. You can define separate documentation for various API versions or sections.

### JSON Response Examples
To provide clarity, this example includes JSON response examples for each endpoint, helping users understand the expected data format.

### HTTP Methods
All major HTTP methods, including POST, PATCH, DELETE, and GET, are demonstrated using L5-Swagger.

### Passport Security
Passport is integrated to secure your API endpoints. Users will find examples of how to use Passport for authentication and access control.

### Custom Headers in Swagger UI
Custom headers are integrated into the main Swagger UI index blade file. This enhances the user experience by showcasing how to include headers directly in the interactive API documentation.

### License
This project is open-source and available under the MIT License. You are free to use, modify, and distribute it as needed.

### Contributing
If you have suggestions, improvements, or find issues, please feel free to create a GitHub issue or submit a pull request.

### Author
Mirali Thanki <br/>
https://github.com/Meera9 <br/>
meerathanki09@gmail.com
