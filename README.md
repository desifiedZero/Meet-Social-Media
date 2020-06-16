Name: 		Saad Farooq
Roll No: 	Fa-2017/BSCS/086 A
Course: 	Web Engineering
Purpose:	Final Assessment

===================================

`Meet` Social Media Web Application

===================================

MMMMMMMMMN0dc;..        ..;cd0NMMMMMMMMM
MMMMMMNOl'.                  .'lONMMMMMM
MMMMNx,                          ,xNMMMM
MMWO;                              ;OWMM
MNd.                                .dNM
No.      ........             ........oN
x.       lXNXXXXk,           cKXXXXXO'.d
,        oWMMMMMM0;        .oNMMMMMMK; ,
.        oWMMMMMMMKc.     .dNMMMMMMMX; .
         oWMMMMMMMMX0l.  .xWMMMMMMMMX;  
         oWMMMMMMMMMMNd.'kWMMMMMMMMMX;  
.        oWMMMMMMMMMMMW0KWMMMMMMMMMMX; .
c        oWMMMMMMMMMMMMMMMMMMWMMMMMMX; c
0,       oWMMMMMN0NMMMMMMMMW0OWMMMMMX;,0
M0,      oWMMMMM0:cXMMMMMMWx'lWMMMMMXk0W
MMK:     oWMMMMM0, ;xKMMMWd. lNMMMMMMWMM
MMMNx,   oWMMMMM0,   .cll;.  lNMMMMMMMMM
MMMMMNk:.,llllll:.           .lkXMMMMMMM
MMMMMMMWKxc'.              .'cxKWMMMMMMM
MMMMMMMMMMWXOo;..      ..;oOXWMMMMMMMMMM

NOTE: The project, as much as I wanted it to be, is not complete. Mostly due to having a lot of pressure these days. Some features may be missing. But most of them work flawlessly.
P.S.: Some upload images are missing as I accidentally deleted them.

AUTH:	username, 	password
	desified,	root
	shozibabbas, 	root
	faranshahid,	root
	faranshahid1,	root
	frq67,		root
	fattyboi26,	fattyboi
	salmanahmad_10,	qweqwe

	(YOU CAN ALSO MAKE YOUR OWN)

Only desified is friends with shozibabbas and faranshahid. The feed feature can be tested by logging into desified.

--------------TREE----------------

.
├── api
│   └── user_add_post.php
├── config.php
├── covid.php
├── css
│   └── style.css
├── dbcon.php
├── friends_list.php
├── functions.php
├── images
│   ├── logo.png
│   ├── post1.jpeg
│   └── user.png
├── includes
│   ├── displayProfilePosts.snippet.php
│   ├── header.php
│   └── newpost.snippet.php
├── index.php
├── js
│   ├── nav.js
│   └── new_post.js
├── login.php
├── logout.php
├── messages.php
├── profile.php
├── settings.php
├── signup.php
├── uploads
│   ├── 170ff511662dfbb3a6ad9afc6907af1d_Screenshot (27).png
│   ├── 49e7fe6b882db44f7740943934c86bb7_screenshot (27).png
│   ├── 5446b5e47bb1de333990abc070d1e912_screenshot (27).png
│   ├── 54ba889c131ebb99db52b76b46697b56_4.jpg
│   ├── 5dc77c9ff69bcec0913f97c75b6864d1Screenshot (27).png
│   ├── Screenshot (27).png
│   ├── Screenshot (37).png
│   ├── a7b0edbbec273e66cc887a76cdcc968f_screenshot (27).png
│   ├── cff88fc08831789a1e4c42ccf58071b3_screenshot (27).png
│   ├── d2bdfd4fa2fb47a628b7b44eeb85af6a_screenshot (27).png
│   └── e3534eee6c4d32c0959668fd3f910f6c_screenshot (27).png
└── validate.php

7 directories, 35 files
_______________________________________________________________________

DIRECTORIES:
- ./uploads : Uploads has the photos uploaded when posted on one's profile.
- ./api : Contains the apis that the program has.
     └── user_add_post.php : Not exactly an api, the function validate_session gets the session_id for the running session for the user.

- ./css : Contains all the css files for the project.

- ./images : Images that are required for the webpage, and not by the user.

- ./includes : Snippets and header that are included in the file where needed.
     └── displayProfilePosts.snippet.php : Snippet that adds posts on profile of a user.
     └── newpost.snippet.php : Snippet that adds a form for a new post.
     └── header.php : The webpage header after the user has successfully logged in.

- ./js : Contains the JavaScript files for the project.
     └── nav.js : Navbar animation.
     └── new_post.js : Ajax handler for creating new post.
_______________________________________________________________________

FILES:
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