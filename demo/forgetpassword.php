<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login for FerasBook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/image1.jpg'); 
            background-size: cover; /* Ensures the image covers the entire background */
            background-position: center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .header-bar {
            width: 100%;
            height: 100px;
            background-color: #3c5a99;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Adjusted to space between items */
            padding: 0 20px; /* Added padding for inner spacing */
            color: white;
            font-size: 40px;
            font-family: 'Georgia', serif;
            font-weight: bold;
            position: fixed;
            top: 0;
            left: 0;
        }
        .header-bar button {
            background-color: #4CAF50; /* Green background */
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-left: auto; /* Pushes the button to the right */
            cursor: pointer;
            margin-right: 40px; /* Added right margin */
        }
        .header-bar button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        .login-container {
            width: 360px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            margin-top: 90px; /* Added margin to push down from header */
        }
        .header {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #3c5a99;
        }
        .header1 {
            margin-bottom: 20px;
            font-size: 65px;
            font-family: 'Georgia', serif;
            font-weight: bold;
            color: #3c5a99;
            text-align: center;
            position: absolute;
            right: 250px; /* Aligns the container to the left of the page */
            top: 30%;
            
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-group input {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #dddfe2;
            border-radius: 5px;
        }
        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #3c5a99;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .login-button:hover {
            background-color: #365899;
        }
        .gsi-material-button {
            display: inline-flex; /* Display as inline-flex for better alignment */
            align-items: center;
            padding: 10px;
            background-color: #ffffff;
            color: #3c5a99;
            border: 1px solid #3c5a99;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none; /* Remove default underline for links */
            transition: background-color 0.3s ease;
        }
        .gsi-material-button:hover {
            background-color: #f0f0f0;
        }
        .gsi-material-button-icon {
            width: 24px; /* Adjust the width as needed */
            height: 24px; /* Adjust the height as needed */
            margin-right: 10px; /* Optional: Add spacing between icon and text */
        }
        .footer {
            margin-top: 20px;
        }
        .footer a {
            color: #3c5a99;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header-bar">Feras Book
 
    </div>
    <div class="login-container">
        <div class="header">Forget Password</div>
        <form action="#">
            <div class="input-group">
                <label for="email">Email or Phone</label>
                <input type="text" id="email" name="email" required>
            </div>

            <button type="submit" class="login-button">Send Massage</button>

   

        </form>
 
      
    </div>
 
</body>
</html>
