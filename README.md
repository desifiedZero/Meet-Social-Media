Meet Social Media Web Application  
-
  
This was my web project that i made in one night. They only allowed languages and no frameworks, so did what had to be done. I am really proud of this, but not really.....u know....
  
7 directories, 35 files  
  
DIRECTORIES
-

- ./uploads : Uploads has the photos uploaded when posted on one's profile.  
- ./api : Contains the apis that the program has.  
     └── user_add_post.php : Not exactly an api, the function validate_session gets the session_id for the running session for the user.  
  
- ./css : Contains all the css files for the project.  
  
- ./images: Images that are required for the webpage, and not by the user.  
  
- ./includes: Snippets and header that are included in the file where needed.  
     └── displayProfilePosts.snippet.php : Snippet that adds posts on profile of a user.  
     └── newpost.snippet.php : Snippet that adds a form for a new post.  
     └── header.php : The webpage header after the user has successfully logged in.  
  
- ./js: Contains the JavaScript files for the project.  
     └── nav.js : Navbar animation.  
     └── new_post.js : Ajax handler for creating new post.  
  
FILES
-

- config.php : Contains configuration along with database connection information.  
- covid.php [VIEW] : Did not have time to create this. Just added "Stay home, stay safe".  
- dbcon.php : Contains a function that creates a connector and returns it.  
- friends_list.php [VIEW] : Page with friends listed in an alphabetical manner.  
- functions.php : Contains many functions that fetch from or insert in database.  
- index.php [VIEW] : This is the main landing page when a user logs in, can be a dashboard.  
- login.php [VIEW] : Contains login form.  
- logout.php : Destroys current session.  
- messages.php [VIEW] : Could not be implemented due to the fact that I was out of time.  
- profile.php [VIEW] : A user's profile. Dynamically change based on 'id' sent through GET.  
- settings.php [VIEW] : Not implemented. But can contain password change.  
- signup.php [VIEW] : Contains sign up form to register a user.  
- validate.php : validates and performs actions on 'sign up' and 'login' data. And starts a new user session by giving him/her a unique md5 hash SESSION_ID.
