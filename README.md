#Introduction to Freedombook

" Freedombook " is a modern social media platform designed to facilitate connection, communication, and community among users. Inspired by the foundational elements of social networking, Freedombook offers a familiar yet improved experience where users can share updates, connect with friends, and engage with content from a diverse community. The platform focuses on user-friendly design, seamless interaction, and a wide range of features that cater to personal expression and social engagement.


In Freedombook, users can easily create posts that can be update, and delete in posts you can interact with others through likes, comments .The platform is designed to be intuitive and accessible, ensuring that users of all ages and backgrounds can navigate and enjoy its features. Whether users are looking to share their latest thoughts, connect with friends, or discover new content, Freedombook provides a dynamic and engaging environment.



The front end of Freedombook will be developed using HTML and CSS, ensuring a responsive and visually appealing user interface. The back end will be powered by PHP and JavaScript, providing the necessary logic and functionality for a seamless user experience. For data management, SQL will be used as the database, ensuring reliable storage and retrieval of user information, posts, and interactions.


Below, we outline the core functionalities that make Freedombook a powerful social media experience:
Login and SignUp
## Login:
###	Purpose: To authenticate users and grant access to their Personal accounts.
###	Description: Users will enter their email and password which is encrepted in database,the program  decrepted then check it to log in.There The "Sign Up" button for new users who haven't created an account yet.
###	User Interface:
-	Elements: A simple login form with fields for email and password, a "Login" button and "Sign Up" button for new clients who need to create an account.
-	Justification: The login interface should be clean and straightforward to minimize and ensure quick access. Including a "Sign Up" button ensures that new clients can easily find where to create an account.

  ![image](https://github.com/user-attachments/assets/40f7ab7b-2dbc-4c1f-af59-a5998a517720)
 

## Sign Up:
###	Purpose: To allow new users to create an account on Ferasbook.
###	Description: Users can sign up by providing their basic information, including first name, last name, gender, date of birth (which must be at least 12 years old), email, password, and confirm password. The "Sign Up" button will remain disabled until all fields are completed, the age is verified as at least 12 years old, and the password and confirm password match.
### User Interface:
#### Elements:
-	A registration form containing:
-	First Name: Text input for the user's first name.
-	Last Name: Text input for the user's last name.
-	Gender: Dropdown with options for "Male" and "Female."
-	Date of Birth: Date input, with a validation check to ensure the user is at least 12 years old.
-	Email or Phone: Text input for either email or phone number.
-	Password: Password input, which will be hashed using PASSWORD_BCRYPT before storing in the database.
-	Confirm Password: Password confirmation input, which must match the "Password" field.
-	Sign Up Button: The button will only be enabled when all fields are filled, the age requirement is met, and the password fields match.
-	Justification: A user-friendly and intuitive sign-up process encourages new users to join the platform. By collecting essential information upfront, Ferasbook ensures that profiles are informative and meet basic platform requirements. The age validation and password matching further enhance security and usability.

![image](https://github.com/user-attachments/assets/5231904d-3f4d-4d2e-9ee7-8c6265897172)

 ![image](https://github.com/user-attachments/assets/b0d2a7fc-03fd-4dcc-83c9-78614d3bd186)


 
## Profile Pages
### Purpose:
To offer users a personal space where they can showcase their activities, manage their posts, and connect with friends.
### Description:
#### Users can view and modify their profile information, including adding or changing their profile and cover photos. The profile page allows users to:
-	Post Content: Users can post new content, view their previous posts, and manage (edit or delete) existing posts.
-	Manage Friends: A dedicated section shows the user’s friends, with options to add friends.
-	Update Information: Users can easily access and edit their profile details by navigating to the Settings tab.
### User Interface:
####	Profile Section:
-	Cover Photo: Users can upload a cover image that spans across the top of the profile.
-	Profile Picture: Displayed in a prominent circular frame, the user can update their profile picture to reflect their identity.
-	User Information: Name and other relevant details are displayed, with quick links to edit this information.
####	Tabs:
-	Home: A navigation link for the user’s personal timeline.
-	Settings: Direct access to manage and update account settings.
-	About: Provides detailed information about the user, including contact details.
####	Friends Section:
-	Friends List: A dedicated sidebar shows the user's friends in a card layout, displaying their profile pictures and names.
-	Friend Management: Easily add new friends or remove existing ones.
####	Post Section:
-	Post Box: A simple text area where users can share what’s on their mind, with the option to attach images.
-	View and Manage Posts: Users can scroll through their posts, edit or delete any post, and interact with them.
### Justification:
- The profile page is designed to be visually appealing and user-friendly. It organizes personal information, posts, and social connections in a clear, structured manner, enabling users to easily navigate and update their profiles.

- New user profile page “when log in for first time“The profile photo well ethire be female or male according to gender

 ![image](https://github.com/user-attachments/assets/4446baf0-07b9-4ee0-9923-cb83ba4c3467)




## Profile Page”Friends Profile”:
### Purpose:
To provide users with a dedicated page where they can view a friend's activities, posts, and connections with others.
### Description:
The Friend's Profile page allows users to:
-	View their friend's posts, photos, and updates.
-	Interact with the content through comments and likes.
-	View the friend's list of connections.
-	Optionally, add the person as a friend if they are not already connected.
### User Interface:
####	Elements:
-	Cover Photo: Displayed at the top of the page to give a personalized touch to the friend's profile.
-	Profile Picture: The friend's profile photo is prominently shown, allowing users to recognize them easily.
####	Tabs:
-	Home: A navigation tab to return to the user's own timeline.
-	About: Provides information about the friend's personal details, such as contact information.
####	Friend Section:
-	This section highlights the user's friends by showing a grid of profile photos and names. It offers easy navigation to other users' profiles.
-	Users can see mutual friends and their connections.
####	Post Section:
-	Displays the friend's recent posts and updates in a clean, organized layout. Posts include text, photos, and timestamps, along with options to like and comment.
-	The page allows the user to see the activity of their friend and interact with it.
### Justification:
- The Friend's Profile page is designed to be visually appealing and well-structured. It organizes the friend's information, posts, and connections in a clear manner, making it easy for users to navigate and engage with the content.

## Profile Page: People Profile (Not Friends):
To provide users with a page where they can view the activities and connections of another user they are not yet friends with, while offering the option to add them as a friend.
### Description:
On the People Profile page, users can:
-	View posts made by the other user and interact by liking or commenting (if permissions allow).
-	See the other user's list of friends.
-	Optionally, send a friend request by clicking the "Add Friend" button if they are not yet connected.
### User Interface:
####	Elements:
-	Cover Photo: Displays the other user's cover photo at the top, giving a personalized touch to their profile.
-	Profile Picture: Prominently shows the user's profile photo to easily identify them.
####	Tabs:
-	Home: Navigates back to the user's own timeline.
-	Settings: Allows the user to access and manage account settings (when logged in).
-	About: Displays more detailed information about the user personal details.
-	Add Friend Button: If the user is not already friends with the profile owner, a prominent "Add Friend" button is displayed, allowing the logged-in user to send a friend request.
####	Friend Section:
-	This section showcases the user's friends, allowing viewers to see their connections. It might include profile photos and names, offering easy access to other profiles.
####	Post Section:
-	Displays the posts and activities of the other user in an organized layout. This section allows the logged-in user to like or comment on posts if available.
### Justification:
- The People Profile page is designed to be visually appealing, organized, and user-friendly. It ensures that users can easily explore another user's profile, interact with their content, and potentially form a new connection by sending a friend request.




## Delete Post page
### Purpose:
- To allow users to delete unwanted posts from their profile.
### Description:
- The page displays the content of the post the user intends to delete, along with a confirmation button ("Delete"). Upon pressing the button, the post is permanently removed, and the user is redirected to their profile page.
### User Interface:
####	Elements:
-	Post Content: Displays the post the user is about to delete, including the post text, image (if any), and timestamp.
-	Delete Button: A "Delete" button positioned below the post. When clicked, it confirms the deletion of the post and navigates the user back to their profile page.
###	Justification: A straightforward deletion system is essential to empower users, allowing them to remove unwanted content with ease and ensuring a clean, user-controlled profile.

## Edit Post page:
### Purpose:
To provide users with the ability to edit their existing posts.
### Description:
This page displays the post the user wants to edit, including an input text area to modify the post content. Below the post is an "Edit" button, which the user clicks to save changes. Once the changes are saved, the user is redirected back to their profile page.
### User Interface:
####	Elements:
-	Post Preview: Displays the existing post, including any images, alongside the post's timestamp.
-	Text Area: Allows users to input the new post content.
-	Edit Button: Saves the new content and redirects the user to their profile page after editing.
###	Justification:
- The simple, straightforward design ensures users can easily edit their posts. The layout highlights the post for review, with the text area below to facilitate quick and efficient editing. The "Edit" button is placed directly under the input field to enhance the user experience.

## Comments Post page
### Purpose:
To allow users to comment on posts and view existing comments.

### Description:
The page displays the post a user wants to comment on, including the post's content, any associated images, and a text box for entering new comments. Users can submit their comment using the provided input fields, and any existing comments on the post are also displayed below for easy interaction and engagement.

### User Interface:
####	Elements:
-	Post Display: Shows the post content, including the text, image, timestamp, and the poster's profile picture.
-	Comment Box: Provides an input area for users to type their comments, along with an option to upload files.
-	Old Comments Section: Displays all previous comments made on the post, along with the commenters' profile images and the time each comment was posted.
###	Justification:
- The simple and intuitive design enables users to easily comment on posts, fostering interaction and engagement. The layout mirrors the familiar structure from the profile page, allowing for a seamless user experience while viewing and adding comments to posts.



## Like Post Functionality:
### Purpose: To manage the process of liking a post, ensuring that users can like posts without duplicating their actions and updating the database accordingly.
### Description: This method checks if the user has already liked a specific post and updates the like count in the database. It handles both scenarios where a post already has likes and where it's the first like.
### Workflow:
1.	Database Connection:
-	The method initializes a new instance of the DataBase class to interact with the database.
2.	Like Retrieval:
-	It constructs a SQL query to retrieve existing likes for the specified post from the likes table. The query checks for likes related to the post ID.
3.	Check for Existing Likes:
-	If likes are found (result is an array and contains data), it decodes the JSON-encoded likes into an array.
-	The method extracts user IDs from the likes to check if the current user has already liked the post.
4.	Processing the Like:
-	If the user hasn't liked the post yet:
1.	A new like entry is created with the current user's ID and the date of the like.
2.	The method updates the likes count in the posts table by incrementing it.
3.	The updated likes array is then encoded back to JSON and stored in the likes table.
-	If the user has already liked the post, no action is taken.
5.	First Like Handling:
-	If no likes exist for the post, the method creates a new entry in the likes array for the current user and encodes it to JSON.
-	A new record is inserted into the likes table with the type, content ID, and the newly created likes data.
-	The likes count for the post is also updated in the posts table to reflect the new like.




## About page:
###	Purpose:
The purpose of this page is to allow users to view general information about themselves or others, including name, email, gender, and date of birth.
###	Description:
This page displays the user's profile information, either for the logged-in user or other users, depending on the context. It serves as a profile overview, showcasing key details such as the user's full name, email address, gender, and date of birth.
###	User Interface:
####	Elements:
-	The header displays the platform name "FerasBook" along with a search bar and options to view the profile or log out.
-	A section shows the profile photo of the user with a link to the profile page.
-	Below the profile photo, the user's first and last name, email, gender, and date of birth are displayed in clearly labeled sections.
###	Features:
-	The page dynamically loads and displays the profile image and general information based on the logged-in user’s data.
-	If the user is viewing their own profile, they can access settings to update their information.



## Settings page
### Purpose: To allow users to change their names and passwords.
### Description: This page features input fields for first name, last name, and password. Users can update their names using one button and their passwords using another.
###User Interface:
####	Elements:
-	Input fields for first name and last name
-	Input fields for password and confirm password
-	Two separate buttons for submitting name and password changes



## Home Page:
### Purpose: To display a variety of posts from the user’s friends and the wider community.
### Description: The home page serves as the central hub where users can view posts from friends and trending content. Users can like, comment, and create new posts.
### User Interface:
#### Elements:
-	A vertically scrolling feed with posts displayed in cards.
-	Each post shows the user's avatar, name, timestamp, and interaction buttons (like, comment).
###	Justification: The home page is designed for easy browsing, allowing users to stay engaged with content from their network and the broader FerasBook community.

 ![image](https://github.com/user-attachments/assets/4a69a68e-25c5-4a8c-b1c7-26cd58c964b3)


## Search Page
Search Functionality

###	Purpose: To allow users to find friends and other users .
###	Description: The search function should be accessible from any page and allow users to search for people and friends. Results should be categorized and filterable.
###	User Interface:
####	Elements: A prominent search bar at the top of every page, with an autocomplete feature for quick results. The search results page should display categorized results .
###	Justification: A robust search function enhances usability, making it easy for users to find and connect with others, discover new content, and navigate the platform.




## Image Cropping Functionality:
### Purpose: To resize and crop an image to specified maximum dimensions while maintaining the aspect ratio.
### Description: This method takes an original image file and creates a cropped version based on the provided maximum width and height. It handles different aspect ratios, ensuring the final image fits within the specified dimensions.
###Workflow:
1.	Check Image Existence:
-	The method first checks if the original image file ($OG_file) exists. If it does, it creates an image resource from the JPEG file using imagecreatefromjpeg.
2.	Get Original Dimensions:
-	The original width and height of the image are retrieved using imagesx and imagesy.
3.	Aspect Ratio Calculation:
-	The method calculates the new dimensions based on the maximum width and height:
-	If the original height is greater than the width (portrait), it calculates the new height using the ratio of the maximum width.
-	Otherwise, it calculates the new width using the ratio of the maximum height.
4.	Adjustment for Non-Square Dimensions:
-	If the maximum width and height are not equal, the method checks which dimension is smaller and adjusts both dimensions to ensure the image maintains its aspect ratio within the specified limits.
5.	Create New Resized Image:
-	A new image resource is created with the calculated dimensions using imagecreatetruecolor.
-	The original image is resampled into the new image using imagecopyresampled.
6.	Free Original Image Memory:
-	The original image resource is destroyed to free up memory.
7.	Calculate Cropping Offsets:
-	The method calculates offsets (x and y) for cropping based on the difference between the new dimensions and the maximum dimensions. This ensures the image is centered during cropping.
8.	Create Cropped Image:
-	A new image resource for the cropped image is created with the maximum dimensions.
-	The resized image is then copied into the cropped image resource using the calculated offsets.
9.	Free Resized Image Memory:
-	The resized image resource is destroyed to free up memory.
10.	Save the Cropped Image:
-	The final cropped image is saved to the specified output file ($CB_file) using imagejpeg, with a quality setting of 90%.
11.	Free Cropped Image Memory:
-	The cropped image resource is destroyed to free up memory.
