#Team Members:
---

Kareem Khattab : 009025692

Kevin Hou : 008345688

#Setup 
---

1. Create a new database in phpmyadmin.
2. Update the config.php DBNAME for the table you just created.
  ```
  class Config {
	
    const DBUSER = "root";
    const DBPASS = "";
    const DBNAME = "nameofdb";
    const DBHOST = "localhost";
    const BASEURL = "http://localhost/hw3";
    const TEXT_MIN_LENGTH = 1;
    const TEXT_MAX_LENGTH = 5000;
  }

  ```
3. Load mockdata by visiting the script through its url http://localhost/hw3/configs/CreateDB.php

**Be sure to edit Base URL if needed to match where our HW3 folder is located.**

#Contact Us
---

If you have any issues setting up our project email us so we can fix it for you.

kareem.khattab@sjsu.edu

kevin.hou@sjsu.edu