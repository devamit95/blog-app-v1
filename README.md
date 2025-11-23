# Blog Application

A full-featured blog application built with Laravel 9, featuring user authentication, role-based access control, social login, commenting system, and comprehensive audit logging.

## Features

### 🔐 Authentication & Authorization
- **User Registration & Login** - Traditional email/password authentication using Laravel Breeze
- **Social Login** - OAuth integration with Google and Facebook via Laravel Socialite
- **Role-Based Access Control** - Admin and User roles with custom middleware
- **Email Verification** - Optional email verification for new accounts
- **Password Reset** - Secure password recovery system

### 📝 Blog Management
- **CRUD Operations** - Create, read, update, and delete blog posts
- **Soft Deletes** - Posts are soft-deleted and can be restored by admins
- **Authorization Policies** - Users can only edit/delete their own posts (admins can manage all)
- **Rich Content** - Support for long-form content with text areas
- **Post Ownership** - Each post is associated with its author

### 💬 Comments System
- **Nested Comments** - Users can comment on blog posts
- **Comment Management** - Edit and delete own comments
- **User Attribution** - Comments display author information
- **Cascading Deletes** - Comments are removed when posts or users are deleted

### 👨‍💼 Admin Panel
- **Dashboard** - Overview with statistics (users, posts, comments count)
- **User Management** - View, edit, and manage all users
- **Post Management** - Full control over all posts including soft-deleted ones
- **Post Restoration** - Restore soft-deleted posts
- **Protected Routes** - Admin-only access with role middleware

### 🔍 Advanced Features
- **Repository Pattern** - Clean architecture with PostRepository interface
- **Dependency Injection** - Service container binding for repositories
- **Query Caching** - Redis/file-based caching for improved performance
- **View Composers** - Recent posts shared across all views
- **Audit Logging** - Comprehensive activity tracking with IP addresses
- **Custom Middleware** - Audit logger and role-based access control
- **Database Indexing** - Optimized queries with proper indexes
- **Eager Loading** - Prevents N+1 query problems

### 🎨 Frontend
- **Tailwind CSS** - Modern, responsive UI design
- **Alpine.js** - Lightweight JavaScript framework for interactivity
- **Blade Templates** - Laravel's templating engine
- **Vite** - Fast build tool for assets
- **Flash Messages** - User feedback for actions
- **Responsive Design** - Mobile-friendly interface

## Requirements

- PHP >= 8.0.2
- Composer
- MySQL/MariaDB
- Node.js & NPM
- Web Server (Apache/Nginx)

## Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd blog-app-v1
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Environment Configuration
```bash
# Copy the example environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Database
Edit `.env` file and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Configure Social Login (Optional)
Add your OAuth credentials to `.env`:
```env
# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT=http://localhost:8000/login/google/callback

# Facebook OAuth
FACEBOOK_CLIENT_ID=your_facebook_client_id
FACEBOOK_CLIENT_SECRET=your_facebook_client_secret
FACEBOOK_REDIRECT=http://localhost:8000/login/facebook/callback
```

### 7. Run Database Migrations
```bash
php artisan migrate
```

### 8. Seed Database (Optional)
```bash
php artisan db:seed
```

### 9. Build Frontend Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 10. Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Default Admin Account

After seeding, you can create an admin user manually:
```bash
php artisan tinker
```
```php
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);
```

## Project Structure

```
blog-app-v1/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin panel controllers
│   │   │   ├── Auth/           # Authentication controllers
│   │   │   ├── PostController.php
│   │   │   ├── CommentController.php
│   │   │   └── DashboardController.php
│   │   ├── Middleware/
│   │   │   ├── AuditLoggerMiddleware.php
│   │   │   └── RoleMiddleware.php
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Post.php
│   │   ├── Comment.php
│   │   └── AuditLog.php
│   ├── Policies/
│   │   └── PostPolicy.php
│   ├── Providers/
│   │   └── BlogServiceProvider.php
│   └── Repositories/
│       ├── PostRepository.php
│       └── EloquentPostRepository.php
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── admin/              # Admin panel views
│   │   ├── auth/               # Authentication views
│   │   ├── posts/              # Blog post views
│   │   └── layouts/            # Layout templates
│   ├── css/
│   └── js/
└── routes/
    ├── web.php
    ├── api.php
    └── auth.php
```

## Key Routes

### Public Routes
- `GET /` - Homepage (list all posts)
- `GET /posts/{post}` - View single post

### Authenticated Routes
- `GET /dashboard` - User dashboard
- `GET /posts/create` - Create new post
- `POST /posts` - Store new post
- `GET /posts/{post}/edit` - Edit post
- `PUT /posts/{post}` - Update post
- `DELETE /posts/{post}` - Delete post
- `POST /posts/{post}/comments` - Add comment

### Admin Routes (prefix: /admin)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/users` - Manage users
- `GET /admin/posts` - Manage all posts
- `POST /admin/posts/{id}/restore` - Restore deleted post

### Social Login
- `GET /login/{provider}` - Redirect to OAuth provider
- `GET /login/{provider}/callback` - OAuth callback handler

## Database Schema

### Users Table
- id, name, email, password
- role (admin/user)
- provider, provider_id (for social login)
- email_verified_at, remember_token
- timestamps, soft deletes

### Posts Table
- id, user_id, title, content
- timestamps, soft deletes

### Comments Table
- id, user_id, post_id, content
- timestamps

### Audit Logs Table
- id, user_id, action, ip_address
- route, description (JSON)
- timestamps

## Testing

Run the test suite:
```bash
php artisan test
```

## Security Features

- CSRF Protection on all forms
- SQL Injection prevention via Eloquent ORM
- XSS Protection via Blade templating
- Password hashing with bcrypt
- Authorization policies for resource access
- Role-based middleware
- Audit logging for accountability

## Performance Optimizations

- Query result caching (60 seconds TTL)
- Eager loading to prevent N+1 queries
- Database indexing on foreign keys
- View composers for shared data
- Asset bundling with Vite

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues and questions, please open an issue on the GitHub repository.

## Technologies Used

- **Backend**: Laravel 9, PHP 8.0+
- **Frontend**: Blade, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Authentication**: Laravel Breeze, Laravel Socialite
- **Build Tools**: Vite, NPM
- **Testing**: PHPUnit
- **Code Quality**: Laravel Pint

## Acknowledgments

- Laravel Framework
- Laravel Breeze for authentication scaffolding
- Laravel Socialite for OAuth integration
- Tailwind CSS for styling
- Alpine.js for JavaScript interactions
