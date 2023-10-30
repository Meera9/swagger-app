# Laravel L5-Swagger Example

This is an example Laravel application that demonstrates how to use L5-Swagger to generate API documentation, attach
custom headers to your API, and set up multiple routes for your documentation.

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

### <a href="https://github.com/Meera9/swagger-app/blob/main/config/l5-swagger.php">Multiple Route Setup</a>

This example includes multiple routes to demonstrate the flexibility of L5-Swagger in documenting your API. You can
define your routes in the routes/api.php file. The Swagger documentation will automatically update to include these
routes.

### <a href="https://github.com/Meera9/swagger-app/blob/main/config/l5-swagger.php">Multiple Documentation</a>

This example includes multiple documentation to showcase different aspects of your API. You can define separate
documentation for various API versions or sections.

#### In Config/l5-swagger.php file: <br/>

    'default'        => 'default', // you can change admin to any name you want
     ...
    'documentations' => [
       ...
       'defaults' => [
           'routes' => [
               'api'     => 'documentation',
               'docs'   => '/api/default/docs',
               'oauth2_callback'   => '/api/default/callback',
           ],
       ...
       ],
       'admin' => [
       ...
           'routes' => [
               'api'     => 'documentation/admin',
               'docs'   => '/api/admin/docs',
               'oauth2_callback'   => '/api/admin/callback',
           ],
       ...
       ],
    ],

### <a href="https://github.com/Meera9/swagger-app/blob/main/app/Http/Controllers/Admin/ProductController.php">JSON Response Examples</a>

To provide clarity, this example includes JSON response examples for each endpoint, helping users understand the
expected data format.

    /**
     * @OA\Get(
     *     path="/api/admin/products",
     *  ....,
     *     security={{"passport": {}}},
     *  ....,
      *     @OA\Response(
     *         response=200,
     *         description="List of products",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "title": "Dr.",
     *                         "description": "Voluptates dolorem facilis molestias voluptas optio et. Magnam exercitationem nulla neque est provident cum. Voluptatibus corrupti quam qui voluptatem maxime delectus. Tempora consequuntur fugit voluptatem qui adipisci enim.",
     *                         "created_at": "2023-10-28T16:47:58.000000Z",
     *                         "updated_at": "2023-10-28T16:47:58.000000Z"
     *                     }
     *                 },
     *                 "links": {
     *                     "first": "http://swagger-app.test/api/products?page=1",
     *                     "last": "http://swagger-app.test/api/products?page=2",
     *                     "prev": null,
     *                     "next": "http://swagger-app.test/api/products?page=2"
     *                 },
     *                 "meta": {
     *                     "current_page": 1,
     *                     "from": 1,
     *                     "last_page": 2,
     *                     "links": {
     *                         {
     *                             "url": null,
     *                             "label": "&laquo; Previous",
     *                             "active": false
     *                         },
     *                         {
     *                             "url": "http://swagger-app.test/api/products?page=1",
     *                             "label": "1",
     *                             "active": true
     *                         },
     *                         {
     *                             "url": "http://swagger-app.test/api/products?page=2",
     *                             "label": "2",
     *                             "active": false
     *                         },
     *                         {
     *                             "url": "http://swagger-app.test/api/products?page=2",
     *                             "label": "Next &raquo;",
     *                             "active": false
     *                         }
     *                     },
     *                     "path": "http://swagger-app.test/api/products",
     *                     "per_page": 10,
     *                     "to": 10,
     *                     "total": 20
     *                 }
     *             }
     *         )
     *     ),
     * )
     */


### <a href="https://github.com/Meera9/swagger-app/blob/main/app/Http/Controllers/Admin/ProductController.php">HTTP Methods</a>

All major HTTP methods, including POST, PATCH, DELETE, and GET, are demonstrated using L5-Swagger.

### <a href="https://github.com/Meera9/swagger-app/blob/main/app/Http/Controllers/Admin/ProductController.php">Passport Security</a>

Passport is integrated to secure your API endpoints. Users will find examples of how to use Passport for authentication
and access control. <br/>

#### In Config/l5-swagger.php file: <br/>

    'passport' => [ // Unique name of security
        'type'        => 'apiKey', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
        "description" => 'Enter token in format (Bearer <token>)',
        'in'          => 'header',
        "name"        => "Authorization",
        'scheme'      => 'bearer',
        'flows'       => [
            "password" => [
                "authorizationUrl" => config('app.url') . '/oauth/authorize',
                "tokenUrl"         => config('app.url') . '/oauth/token',
                "refreshUrl"       => config('app.url') . '/token/refresh',
                "scopes"           => [],
            ],
        ],
    ],

#### In Controller file of method <br/>

    /**
     * @OA\Get(
     *     path="/api/admin/products",
     *  ....,
     *     security={{"passport": {}}},
     *  ....,
     */

### <a href="https://github.com/Meera9/swagger-app/commit/f6e7fd820deb5d3cdeb52916b30e76a8884a2199">Custom Headers in Swagger UI</a>

Custom headers are integrated into the main Swagger UI index blade file. This enhances the user experience by showcasing
how to include headers directly in the interactive API documentation. Path is
resources/views/vendor/l5-swagger/index.blade.php

    requestInterceptor: function(request) {
            request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
            request.headers['Content-Lang'] = 'en';
            request.headers['Content-Timezone'] = 'Asia/Calcutta';
            request.headers['Content-Timezone'] = 'Asia/Calcutta';
            request.headers['X-Requested-With'] = 'XMLHttpRequest';
            return request;
    },


### License
This project is open-source and available under the MIT License. You are free to use, modify, and distribute it as needed.

### Contributing
If you have suggestions, improvements, or find issues, please feel free to create a GitHub issue or submit a <a href="https://github.com/Meera9/swagger-app.git">pull request</a>.

### Author
<a href="https://github.com/Meera9">Mirali Thanki</a> <br/>
<a href="mailto:meerathanki09@gmail.com">Contact Me</a>

