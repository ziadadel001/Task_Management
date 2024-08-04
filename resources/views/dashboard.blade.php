<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
            background-color: #f8f9fa;
        }

        .task-card {
            margin-bottom: 20px;
        }

        .task-title {
            font-weight: bold;
        }

        .completed {
            text-decoration: line-through;
        }

        .btn-custom {
            margin-right: 5px;
        }

        .card-header {
            font-size: 1.25rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="">Tasks</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Settings</a>

                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Task Management Section -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="container">
                    <h1 class="text-center mb-4">Task Management Dashboard</h1>

                    <!-- Add Task Section -->
                    <div class="card task-card mb-4">
                        <div class="card-header bg-primary text-white">
                            Add New Task
                        </div>
                        <div class="card-body">



                            <form class="mx-auto" style="max-width: 600px;" method="POST"
                                action="{{ route('Task.store') }}">
                                @csrf

                                <!-- Display Success Message -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="taskTitle">Title</label>
                                    <input type="text" name="name" class="form-control" id="taskTitle"
                                        placeholder="Enter task title" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="taskDescription">Description</label>
                                    <textarea class="form-control" name="description" id="taskDescription" rows="3"
                                        placeholder="Enter task description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="taskDueDate">Due Date</label>
                                    <input type="date" name="due_date" class="form-control" id="taskDueDate"
                                        value="{{ old('due_date') }}">
                                    @error('due_date')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="taskCategory">Category</label>
                                    <select class="form-control" name="category" id="taskCategory">
                                        <option value="Work" {{ old('category') == 'Work' ? 'selected' : '' }}>Work
                                        </option>
                                        <option value="Study" {{ old('category') == 'Study' ? 'selected' : '' }}>Study
                                        </option>
                                        <option value="Personal" {{ old('category') == 'Personal' ? 'selected' : '' }}>
                                            Personal</option>
                                    </select>
                                    @error('category')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Add Task</button>
                            </form>





                        </div>
                    </div>

                    <!-- Current Tasks Section -->
                    <div class="card task-card mb-4">
                        <div class="card-header bg-warning text-dark">
                            Current Tasks
                        </div>
                        <div class="card-body">
                            @foreach ($incompleteTasks as $Itask)
                                <div class="task mb-3 p-3 border rounded bg-light">
                                    <p class="task-title">{{ $Itask->name }} <span
                                            class="badge badge-secondary">{{ $Itask->category }}</span></p>
                                    <p>{{ $Itask->description }}</p>
                                    <p>Due Date: {{ $Itask->Due_Date }}</p>
                                    <a href="{{ route('Complete.store', $Itask->id) }}"> <button
                                            class="btn btn-success btn-custom">Mark as Completed</button> </a>
                                    <a href="{{ route('DeleteTask', $Itask->id) }}"> <button
                                            class="btn btn-danger btn-custom">Delete</button></a>
                                </div>
                            @endforeach


                        </div>
                    </div>

                    <!-- Completed Tasks Section -->
                    <div class="card task-card mb-4">
                        <div class="card-header bg-success text-white">
                            Completed Tasks
                        </div>
                        <div class="card-body">
                            @foreach ($completedTasks as $Ctask)
                                <div class="task mb-3 p-3 border rounded bg-light">
                                    <p class="task-title completed"> {{ $Ctask->name }}<span
                                            class="badge badge-secondary">{{ $Ctask->category }}</span></p>
                                    <p>{{ $Ctask->description }}</p>
                                    <p>Due Date: {{ $Ctask->Due_Date }}</p>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
