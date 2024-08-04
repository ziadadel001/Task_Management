<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management - Your Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        header {
            padding: 10px 20px;
            background-color: #FF2D20;
            color: white;
            display: flex;
            justify-content: flex-end; /* Align items to the left */
            align-items: center;
            gap: 10px; /* Space between buttons */
        }
        header a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: transparent;
            border: 1px solid white;
            transition: background-color 0.3s, color 0.3s;
        }
        header a:hover {
            background-color: white;
            color: #FF2D20;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            width: 100%;
            height: auto;
        }
        .card-content {
            padding: 20px;
        }
        .card-content h2 {
            margin-top: 0;
            color: #FF2D20;
        }
        .card-content p {
            margin: 10px 0;
            line-height: 1.6;
        }
        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    
    <header>
        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    
    <div class="container">
        <div class="main">
            <div class="card">
                <img src="https://via.placeholder.com/1200x600.png?text=Task+Manager+Screenshot" alt="Task Manager Screenshot">
                <div class="card-content">
                    <h2>Task Management</h2>
                    <p>
                        The Task Management Project provides powerful tools to organize and track tasks. This project helps you manage your tasks effectively,
                        set priorities, and track progress. With a simple and user-friendly interface, you can quickly and easily add, edit, and delete tasks.
                    </p>
                    <p>
                        Key features include: recurring task management, reminders, priority setting, and integration with external calendars.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Task Management Project. All rights reserved.</p>
    </footer>

</body>
</html>
