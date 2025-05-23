<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Friend | FerasBook</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        body {
            background-color: #f0f2f5;
        }
        .navbar {
            background-color: #4267B2;
            padding: 15px;
            color: white;
            text-align: center;
        }
        .navbar h1 {
            margin: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
        }
        .user-list {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        .user {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #ddd;
        }
        .user:last-child {
            border-bottom: none;
        }
        .user img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 20px;
        }
        .user-info {
            flex: 1;
        }
        .user-info h4 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .user-info p {
            font-size: 14px;
            color: #666;
        }
        .add-friend-btn {
            background-color: #4267B2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .add-friend-btn:hover {
            background-color: #365899;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <h1>FerasBook</h1>
    </div>

    <!-- Container -->
    <div class="container">
        <div class="user-list">
            <h2>Add Friends</h2>

            <!-- User Item -->
            <div class="user">
                <img src="https://via.placeholder.com/50" alt="User 1">
                <div class="user-info">
                    <h4>John Doe</h4>
                    <p>New York, USA</p>
                </div>
                <button class="add-friend-btn">Add Friend</button>
            </div>

            <!-- User Item -->
            <div class="user">
                <img src="https://via.placeholder.com/50" alt="User 2">
                <div class="user-info">
                    <h4>Jane Smith</h4>
                    <p>London, UK</p>
                </div>
                <button class="add-friend-btn">Add Friend</button>
            </div>

            <!-- User Item -->
            <div class="user">
                <img src="https://via.placeholder.com/50" alt="User 3">
                <div class="user-info">
                    <h4>Michael Brown</h4>
                    <p>Berlin, Germany</p>
                </div>
                <button class="add-friend-btn">Add Friend</button>
            </div>

            <!-- User Item -->
            <div class="user">
                <img src="https://via.placeholder.com/50" alt="User 4">
                <div class="user-info">
                    <h4>Emily Davis</h4>
                    <p>Paris, France</p>
                </div>
                <button class="add-friend-btn">Add Friend</button>
            </div>

        </div>
    </div>

</body>
</html>
