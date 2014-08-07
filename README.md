Halaman Kompetisi
=================

A Laravel-based web application for competition announcement.

Requirements
------------

 * PHP 5.4+
 * MCrypt PHP Extension

Quick Instalation Guide
-----------------------

### Cloning Halaman Kompetisi

Clone a copy of Halaman Kompetisi git repository by running

```bash
git clone git://github.com/sokokaleb/halkom.git
```

on your web server.

### Configurations

#### Application Configuration

In `/halkom/app/config/database.php`, change the `url` to your own website url, change the `timezone` to your desired timezone based on [list of supported timezones](http://php.net/manual/en/timezones.php), and provide an encryption key.

For example, change

```php
'url' => ''
'timezone' => ''
'key' => ''
```

into

```php
'url' => 'http://www.mywebpage.com'
'timezone' => 'Asia/Jakarta'
'key' => '1d36dd4f3a2474c476baa62fa402be3f'
```

#### Database Configuration

Change the database configuration based on the one you use on your server. Make sure you changed the `default` field too.

For example, I use MySQL on my localhost, so I changed:

```php
'database'  => '',
'username'  => '',
'password'  => '',
```

into

```php
'database'  => 'database_name',
'username'  => 'mysql_uname',
'password'  => 'mysql_password',
```

#### Final Configuration

After you finished application and database configuration, run the following commands on your main directory.

```bash
bash ./setup.sh
```

Test whether the instalation went ok by visiting your website.

Default user is `admin` with password `admin`.

Changelog
---------

#### 0.1.0

Existing pages:

* Homepage
* Competitions (Competition List)
* Individual Competition Page
* User Account Settings

To-Do
-----

#### Pages

#### Non-technical

* Make a neat documentation

License
-------

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

Foundation is licensed under the [MIT license](http://opensource.org/licenses/MIT).