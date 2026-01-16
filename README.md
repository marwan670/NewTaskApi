Task Description | وصف التاسك
Build a Task Management REST API using Laravel.
You are required to apply:
⦁ Repository Pattern
⦁ Factory Pattern
⦁ RESTful API best practices

Authentication (API)
⦁ Laravel Sanctum
⦁ Endpoints:
⦁ POST /api/register
⦁ POST /api/login
⦁ POST /api/logout

Task Entity
Each task must contain:
⦁ id
⦁ title
⦁ description
⦁ status (pending | in_progress | done)
⦁ due_date
⦁ user_id

Tasks API (CRUD)
Method Endpoint
GET /api/tasks
POST /api/tasks
GET /api/tasks/{id}
PUT /api/tasks/{id}
DELETE /api/tasks/{id}

Repository Pattern
⦁ folder => Repositories
=> eloquent => TaskRepository & UserRepository
=> interface => Taskinterface & Userinterface

Factory Pattern
⦁ folder => factories
=> TaskRepositoryFactory
