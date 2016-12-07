#Team Members:
---

Kareem Khattab : 009025692

Kevin Hou : 008345688

Avinash More : 011145550

#Setup 
---

1. Drag Hw5 folder into Apache document root. 

2. Run `composer install` from the command line to install dependencies like gettext, stripe, etc. 

3. Navigate to the Hw5 directory and from the command line, run `php CreateDB.php` to intialize the database and table. Please make sure you have ran the composer command in step 2 as we use a mysqli helper class which can effect your db creation. 

4. You should be at the main page and have the ability to enter data. Please enter a valid test card from https://stripe.com/docs/testing (We used 4242424242424242) and a future expiration month and year. 

5. If you enter data in an incorrect format, proper validation will be thrown. On the next page you will see a link to download your submission in pdf format or send another wish. 

*Note*: You should have a smtp mail server set up to test the mail functionality, we have verified it on our end. 

*Note:* In our config we used 127.0.0.1 as our DBHOST, please make sure to update the config file with your Apache configuration. 

*Note:* In our config we are leaving our stripe keys but feel free to replace them with yours. The assignment says to assume you will be putting in your own keys. 
