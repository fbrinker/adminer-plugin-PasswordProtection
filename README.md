#Adminer Plugin: PasswordProtection

[Adminer](http://www.adminer.org/) (formerly phpMinAdmin) is a full-featured database management tool written in PHP. Conversely to phpMyAdmin, it consist of a single file ready to deploy to the target server. Adminer is available for MySQL, PostgreSQL, SQLite, MS SQL, Oracle, SimpleDB, Elasticsearch and MongoDB. 

**This plugin** protects the Database-Login of Adminer with a password, an easy alternative for a htaccess login page.

For more plugins visit the [Adminer Plugin Page](http://www.adminer.org/plugins/).

### Installation
Follow the Plugin installation introduction at the [official adminer website](http://www.adminer.org/plugins/) and copy the PasswordProtection.php into your Adminer plugins folder.

### How to use
In line 6 of the plugin code, replace the predefined hash with your sha1 password hash.
To generate a sha1 password hash, you can use online tools like [sha1-online](http://www.sha1-online.com/).
