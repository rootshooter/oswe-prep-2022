# Web app build instructions


> Download XAMPP

> Access /phpmyadmin, create table:

    CREATE TABLE comments (
        id int NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        usercomment varchar(255),
        shown boolean DEFAULT FALSE,
        PRIMARY KEY (id)
    ); 

> Drop code into XAMPP public folder, probably C:/xampp/htdocs/

>ensure you have internet connection for Bootstrap CDN bits.

>> .. the rest should just work!
