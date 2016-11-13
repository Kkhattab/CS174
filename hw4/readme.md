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
}

```

3. Load mockdata by visiting the script through its url http://localhost/hw4/CreateDB.php
4. Vist the graph from the db that is mockdata by visiting the url provided: http://localhost/hw4/?c=chart&a=show&arg2=[HASH_OF_DATA]&arg1=LineGraph **Replace the [HASH_OF_DATA] with the hash from the database, for example my hash was 13665484cd59ac94b6caecd80e26bce5. It is the "chart_hash" column in db**
5. Plot points and create your own custom charts!

**Be sure to edit Base URL if needed to match where our HW4 folder is located.**


#Contact Us
---

If you have any issues setting up our project email us so we can fix it for you.

kareem.khattab@sjsu.edu

kevin.hou@sjsu.edu
