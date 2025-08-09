# Mini LMS Laravel

## Installation

### Prerequisites
- Docker and Docker Compose
- Git
Everything else is handled by docker.


### Setup Instructions

> Note: I have added composer scripts to make it easier to use docker and other tool.

1. **Clone the repository**
   ```bash
   git clone git@github.com:WatheqAlshowaiter/mini-lms-laravel.git
   cd mini-lms-laravel
   ```

2. **Copy environment file**
   ```bash
   cp .env.example .env
   ```

3. **Start the Docker containers by running sail:up**
   ```bash
   composer sail:up
   ```

4. **Install PHP dependencies**
   ```bash
   composer sail:install
   ```

5. **Generate application key**
   ```bash
   composer key:generate
   ```

6. **Run database migrations and seeders**
   ```bash
   composer migrate:fresh
   ```

7. **Access the application**
   - API: http://localhost:8080/api
   - MySQL: mysql:3306 (user: root, no password)
   - Redis: redis:6379 (no password)

8. **Postman**
    - import the [postman collection](./Mini_LMS_Laravel.postman_collection.json) to yout postman app.

9. **Run tests**
   ```bash
   composer test
   ```

### Seeded Users (Credentials)
- **Teacher User**
  - Email: teacher@example.com
  - Password: password

- **Student User**
  - Email: student@example.com
  - Password: password

## Troubleshooting

- If you encounter permission issues, run:
  ```bash
  docker-compose exec laravel.test chmod -R 775 storage bootstrap/cache
  ```

- To clear application cache:
  ```bash
  docker-compose exec laravel.test php artisan cache:clear
  docker-compose exec laravel.test php artisan config:clear
  ```

## API Documentation

### Authentication

#### Register a new user
```http
POST /api/register
```
**Request Body**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

#### Login
```http
POST /api/login
```
**Request Body**
```json
{
    "email": "john@example.com",
    "password": "password"
}
```
**Response**
```json
{
    "data": {
        "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com"
        }
    }
}
```

#### Logout
```http
DELETE /api/logout
```
**Headers**
```
Authorization: Bearer your_token_here
Accept: application/json
```

#### Get authenticated user
```http
GET /api/user
```
**Headers**
```http
Authorization: Bearer your_token_here
Accept: application/json
```
**Response**
```json
{
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

### Courses

#### List all courses (Requires authentication)
```http
GET /api/courses
```
**Headers**
```http
Authorization: Bearer your_token_here
Accept: application/json
```
**Response**
```json
{
    "data": [
        {
            "id": 1,
            "title": "Course 1",
            "description": "Description 1",
            "created_at": "2025-08-09 18:21:09",
            "updated_at": "2025-08-09 18:21:09"
        },
        {
            "id": 2,
            "title": "Course 2",
            "description": "Description 2",
            "created_at": "2025-08-09 18:21:09",
            "updated_at": "2025-08-09 18:21:09"
        }
    ]
}
```

#### Create a new course (Requires authentication)
```http
POST /api/courses
```
**Request Body**
```json
{
    "title": "Laravel for Beginners",
    "description": "Learn Laravel from scratch",
    "teacher_id": 1
}
```
**Response**
```json
{
    "data": {
        "id": 3,
        "title": "Laravel for Beginners",
        "description": "Learn Laravel from scratch",
        "teacher_id": 1,
        "created_at": "2025-08-09 18:21:09",
        "updated_at": "2025-08-09 18:21:09"
    }
}
```

#### Get a specific course (Requires authentication)
```http
GET /api/courses/{id}
```
**Headers**
```http
Authorization: Bearer your_token_here
Accept: application/json
```
**Response**
```json
{
    "data": {
        "id": 1,
        "title": "Course 1",
        "description": "Description 1",
        "created_at": "2025-08-09 18:21:09",
        "updated_at": "2025-08-09 18:21:09"
    }
}
```

#### Update a course (Requires authentication)
```http
PUT /api/courses/{id}
```
**Request Body**
```json
{
    "title": "Updated Course Title",
    "description": "Updated course description",
    "teacher_id": 1
}
```
**Response**
```json
{
    {
    "data": {
        "id": 1,
        "title": "Updated Course Title",
        "description": "Updated course description",
        "created_at": "2025-08-09 18:21:09",
        "updated_at": "2025-08-09 18:50:52"
    }
}
}
```

#### Delete a course (Requires authentication)
```http
DELETE /api/courses/{id}
```
**Headers**
```http
Authorization: Bearer your_token_here
Accept: application/json
```


## Checklist
### Requirements
- [x] Setup Laravel project (latest version) with sail or custom docker-compose.
- [x] Implement basic CRUD operations for Course (index, create, update, delete).
- [x] Use FormRequest validation.
- [x] Use Service + Repository pattern.
- [x] Seed 1 teacher user and a few courses.
- [x] Use Laravel Breeze or Passport/Sanctum for login (optional, bonus).
- [x] Push to a public GitHub repository.

### Tech Stack Constraints
- [x] Laravel (latest stable)
- [x] PHP 8.2+
- [x] MySQL (via Docker)
- [x] Docker + docker-compose
- [x] Redis (optional)
- [x] Laravel Sail or custom Docker setup
- [x] GitHub commits must be clean and logical

### Evaluation Criteria
- [x] Docker Setup: Project runs via docker-compose up or sail up
- [x] Code Structure: Organized with services/repositories
- [x] Clean Architecture: Thin controllers, separate logic
- [x] Git Commit Quality: Professional, readable, consistent history
- [x] Laravel Best Practices: FormRequest, migrations, Eloquent, factories
- [x] Bonus Points: Authentication, seeders, feature tests

### Bonus (Optional)
- [x]  Add API routes and use Laravel Resource for Course responses.
- [x]  Add basic login using Laravel Breeze/Sanctum.
- [x]  Add basic feature test for course creation.

### Deliverables
- [x] 1 Public GitHub repo (name it mini-lms-laravel)
- [x] 2 Dockerized Laravel app with seeded data
- [x] 3 Postman collection or example curl commands (bonus)
- [x] 4 Readme with setup, Docker usage, seeded credentials, API samples
