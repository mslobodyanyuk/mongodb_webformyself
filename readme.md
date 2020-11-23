How to make Laravel framework friendly with MongoDb?
====================================================

* ***Actions on the deployment of the project:***

- Making a new project mongodb_webformyself.loc:
				
		sudo chmod -R 777 /var/www/LARAVEL/MongoDB/mongodb_webformyself.loc

		//!!!! .conf
		sudo cp /etc/apache2/sites-available/test.loc.conf /etc/apache2/sites-available/mongodb_webformyself.loc.conf
				
		sudo nano /etc/apache2/sites-available/mongodb_webformyself.loc.conf

		sudo a2ensite mongodb_webformyself.loc.conf

		sudo systemctl restart apache2

		sudo nano /etc/hosts
		
		cd /var/www/LARAVEL/MongoDB/mongodb_webformyself.loc
		
- Deploy project:

	`git clone << >>`
	
	_+ Сut the contents of the folder up one level and delete the empty one._

	`composer install`		
											
- For install MongoDB and Compass follow the tutorial:

Tech On Tech	

[MongoDB Compass Install In Ubuntu]( https://www.youtube.com/watch?v=No_DXalfy60&ab_channel=ProgrammingKnowledge )

MongoDB - 
<https://docs.mongodb.com/manual/installation/>

MongoDB Compass - 
<https://www.mongodb.com/try/download/compass>

_If you encounter an error like:_

"Error: couldn't connect to server 127.0.0.1:27017, connection attempt failed: SocketException: Error connecting to 127.0.0.1:27017 :: caused by :: Connection refused :
	connect@src/mongo/shell/mongo.js:374:17
	@(connect):2:6
	exception: connect failed
	exiting with code 1"
	
_You need to do the following:_
	
	rm /tmp/mongodb-27017.sock

<https://stackoverflow.com/questions/26211671/failed-to-connect-to-127-0-0-127017-reason-errno111-connection-refused>
									
	sudo systemctl start mongod

	sudo service mongod status

	mongo

- Create database in `MongoDB Compass` named like `tlaravel` with collection named `articles`...

- Configure database connection, `.env` file:

```	
DB_CONNECTION=mongodb
DB_HOST=localhost
DB_PORT=27017
DB_DATABASE=tlaravel
DB_USERNAME=
DB_PASSWORD=
```	

If you are using OpenServer:

```
#DB_USERNAME...
#DB_PASSWORD...
```

	//cd /var/www/LARAVEL/MongoDB/mongodb_webformyself.loc
	
	php artisan config:cache

- IF you already have MongoDB PHP Driver installed OR you are using OpenServer which supports it internally - perform MongoDB database steps following the tutorial video.

- Otherwise, you need to install MongoDB PHP Driver first.

* ***To create a project, I installed and configured tools of the following versions:***

	Laravel: 5.8.38 

_+_
	
	MongoDB PHP Driver: 1.7.2
	
_+_	
	
	jenssegers/mongodb package version: 3.5
	
- Laravel: 5.8.38 

Installing the Laravel framework specifying the required version, while the project folder must be empty:

	composer create-project laravel/laravel ./ 5.8

Error:
<https://www.nicesnippets.com/blog/proc-open-fork-failed-cannot-allocate-memory-laravel-ubuntu>

	free -m
	sudo /bin/dd if=/dev/zero of=/var/swap.1 bs=1M count=1024
	sudo /sbin/mkswap /var/swap.1
	sudo /sbin/swapon /var/swap.1

_+_ 

- MongoDB PHP Driver: 1.7.2

[(6:30)]( https://youtu.be/ZhkfsvGh-uw?t=390 )
 IF NOT installed, first install MongoDB PHP Driver.
	( - Included in OpenServer initially, included in the package.)

<https://packagist.org/packages/mongodb/mongodb>

	composer require mongodb/mongodb
						
_When installing the driver, you need to know the location of the `php.ini` file to enable the necessary extensions in it. You can view the paths to the location of files using the `phpinfo()` function. For example, call by specifying in `public/indeх.php` in an empty project folder OR in the `index()` method of the currently used controller:_

```php
<?php
	phpinfo();
```

OR

```php
public function index(){
	phpinfo();
...	
```

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/0.png )

	- To enable extensions, verify that they are enabled in your .ini files:
		- /etc/php/7.2/cli/php.ini

<https://www.php.net/manual/en/mongodb.installation.manual.php>

	php -i | grep extension_dir
		
		extension_dir => /usr/lib/php/20170718 => /usr/lib/php/20170718

	sudo nano /etc/php/7.2/cli/php.ini
		
		extension="/usr/lib/php/20170718/mongodb.so"

	sudo nano /etc/php/7.2/apache2/php.ini
	
		extension="/usr/lib/php/20170718/mongodb.so"
		
	sudo systemctl restart apache2		
	
_+_ 

- jenssegers/mongodb package version: 3.5

[(5:50)]( https://youtu.be/ZhkfsvGh-uw?t=350 )
	
	composer require jenssegers/mongodb 

<https://github.com/jenssegers/laravel-mongodb>

"- Your requirements could not be resolved to an installable set of packages."
		
	composer require jenssegers/mongodb ^3.5

---

WebForMySelf

[How to make Laravel framework friendly with MongoDb? (29:38)]( https://www.youtube.com/watch?v=ZhkfsvGh-uw&ab_channel=WebForMySelf )

It so happened that modern trends in the development of web development are aimed at the total complication of Internet projects. Now you will NOT come across a site with pages with simple text information.
Instead, we are observing the most complex Internet portals that manipulate a huge amount of all kinds of information, both textual and multimedia. And now I'm not talking about the visual component
and an abundance of all kinds of scripts that are executed on the CLIENT side. ALL of this leads to the fact that, in addition to the main functionality, the issue of project speed is quite acute during development. After all, modern
frameworks and CMS, due to their total versatility, are quite demanding on the SERVER AND NOT so fast in their work. Therefore, now EVERYTHING more often we meet such words as "Optimization", "Caching" and "Non-relational
databases"( - OR NoSQL). Moreover, the latter, in comparison with relational databases, work somewhat faster and have good scalability. In this video, we'll talk about how to "make friends" one of the leading
frameworks at this time called Laravel with a prominent representative of NoSQL databases called MongoDB.

[(1:45)]( https://youtu.be/ZhkfsvGh-uw?t=105 )
 MongoDB is an open source document-based database management system(DBMS) that does NOT require a table schema description. This database is classified
like NoSQL and it uses JSON-like documents and, accordingly, database schemas in general.

[(2:25)]( https://youtu.be/ZhkfsvGh-uw?t=145 )
 As a rule, this database is operated using the console, i.e. send a specific set of console commands and receive a specific response.
 
[(2:55)]( https://youtu.be/ZhkfsvGh-uw?t=175 )
 As for the Laravel framework - accordingly, the Laravel framework out of the box with MongoDB, of course, does NOT support. Due to the fact that the Laravel framework works with relational databases that received
most widespread. Such as MySQL, SQLite, PostgreSQL, etc. MongoDB is more used for CLIENT web applications, therefore, support for this database is NOT included in the basic functionality
Laravel framework. BUT, of course, this ALL is fixed due to the fact that for the Laravel framework, and for other frameworks, there are many different extensions in order to expand its functionality.

[(3:45)]( https://youtu.be/ZhkfsvGh-uw?t=225 )
 In this video, just the same, we will get acquainted with one of such extensions that allows you to connect the Laravel framework and the MongoDB database directly. - It is enough to install this extension, make
setting, and we can work, or better even say, store and manipulate data that will be located directly in non-relational databases called MongoDB.

[(4:25)]( https://youtu.be/ZhkfsvGh-uw?t=265 )
 OpenServer uses MongoDB driver support internally.

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/1.png )

[(4:50)]( https://youtu.be/ZhkfsvGh-uw?t=290 )
 For the visual component and for viewing, we will also install the MongoDB Compass program - here we will see the results of our work.( - What database structure is formed, what data is added, etc. )
Created a database `tlaravel` which we will use and in it there is only one document `articles`.

[(5:50)]( https://youtu.be/ZhkfsvGh-uw?t=350 )
 Installing `jenssegers/mongodb`:

	composer require jenssegers/mongodb 
	
<https://github.com/jenssegers/laravel-mongodb>

[(7:30)]( https://youtu.be/ZhkfsvGh-uw?t=450 )
 Add service provider:

"Laravel
In case your Laravel version does NOT autoload the packages, add the service provider to config/app.php:"
		Jenssegers\Mongodb\MongodbServiceProvider::class,
		
- Add the service provider to the array of providers, at the very bottom ...

[(7:45)]( https://youtu.be/ZhkfsvGh-uw?t=465 )
 The `.env` settings are listed further down in the Configuration section.

.env:
	
```	
DB_CONNECTION=mongodb
DB_HOST=localhost
DB_PORT=27017
DB_DATABASE=tlaravel
DB_USERNAME=
DB_PASSWORD=
```	

[(9:45)]( https://youtu.be/ZhkfsvGh-uw?t=585 )

_For general reference: by default, OpenServer is configured so that DB_USERNAME and DB_PASSWORD are NOT needed. The author comments them out._

```
#DB_USERNAME...
#DB_PASSWORD...
```

_- In my case, I left them empty, WITHOUT values._

<https://github.com/jenssegers/laravel-mongodb>

[(9:00)]( https://youtu.be/ZhkfsvGh-uw?t=540 )
 Add mongodb connection in `config/database.php` file:

`config/database.php`:

```php
'mongodb' => [
	'driver' => 'mongodb',
	'host' => env('DB_HOST', '127.0.0.1'),
	'port' => env('DB_PORT', 27017),
	'database' => env('DB_DATABASE', 'homestead'),
	'username' => env('DB_USERNAME', 'homestead'),
	'password' => env('DB_PASSWORD', 'secret'),
	'options' => [
		// here you can pass more settings to the Mongo Driver Manager
		// see https://www.php.net/manual/en/mongodb-driver-manager.construct.php under "Uri Options" for a list of complete parameters that you can use

		'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
	],
],
```	

We reset the cache after specifying the settings:

	php artisan config:cache

[(10:15)]( https://youtu.be/ZhkfsvGh-uw?t=615 )
 As you know, two migrations are described in the Laravel framework (- the first one forms the `users` table, the second one forms a table for password recovery). IF the configurations are correct,
then we will immediately see that the migrations have been successfully applied. - What is the beauty of NoSQL database? - DO NOT form tables, create collections. Each collection contains a certain number of documents. Document
can contain an absolutely arbitrary number of fields. Moreover, these fields can be absolutely arbitrary in terms of data types. Those. you can save information in any way to your
documents...

[(10:30)]( https://youtu.be/ZhkfsvGh-uw?t=630 )
 Let's try to migrate:

	php artisan migrate

[(12:35)]( https://youtu.be/ZhkfsvGh-uw?t=755 )
 Open Compass, we see 3 additional collections have appeared: `migrations`, `password_resets`, `users`.

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/2.png )

[(13:25)]( https://youtu.be/ZhkfsvGh-uw?t=805 )
 Let's create a model for the `articles` collection:

	php artisan make:model Article

[(13:40)]( https://youtu.be/ZhkfsvGh-uw?t=820 )
 Let's also create a `Category` model - let's see how we can define the relationship between two models using MongoDB.
	
	php artisan make:model Category

[(14:05)]( https://youtu.be/ZhkfsvGh-uw?t=845 )
 When we use an extension, we need to make changes in the model; should inherit ALL models of our project from the special class Model, which is already located directly inside
our expansion. We have to inherit ALL the classes of the model. - This is necessary in order to use overrides of standard methods for working with the database. So that we can work with MongoDB database.

_"Eloquent
Extending the base model
This package includes a MongoDB enabled Eloquent class that you can use to define models for corresponding collections:"_

[(14:50)]( https://youtu.be/ZhkfsvGh-uw?t=890 )
 Replace the library in the models with:

```php
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
```
	
 - Override INSTEAD of `use Illuminate\Database\Eloquent\Model`;

`Article.php`:

```php
use Jenssegers\Mongodb\Eloquent\Model;
```

`Category.php`:

```php
use Jenssegers\Mongodb\Eloquent\Model;
```

[(15:00)]( https://youtu.be/ZhkfsvGh-uw?t=900 )
 Please note that in the routes file `routes/web.php` only one route is defined, which is essentially required for this page to work. We will work in `HomeController` in the `index()` method.
And that will essentially be enough.

`routes/web.php`:

```php
Route::get('/', 'HomeController@index');
```

	php artisan make:controller HomeController

[(15:25)]( https://youtu.be/ZhkfsvGh-uw?t=925 )
 Add a new document to the `article` collection. - We form the fields absolutely arbitrarily.

`HomeController.php`:

```php
use App\Article;

public function index(){

	Article::create([
		'title' => "Hello world",
		'text' => "Some text"
	]);
	
	$articles = Article::all();
	
	dump($articles);
	
	return view('welcome');
}
```

[(17:00)]( https://youtu.be/ZhkfsvGh-uw?t=1020 )
 In the model, we must specify a list of fields that are allowed for bulk filling, `$fillable`. It is also desirable to specify a private `$collection` property in each model. In this property, specify
the name of the collection of documents with which the model will work.

`Article.php`: 

```php   
<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Article extends Eloquent
{
    protected $collection = 'articles';
    protected $fillable = ['title', 'text', 'author'];
```

[(18:00)]( https://youtu.be/ZhkfsvGh-uw?t=1080 )
 Let's update the information in the browser - there will already be one article. Let's update one more time - there will already be two articles, absolutely identical.

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/3.png )

[(18:15)]( https://youtu.be/ZhkfsvGh-uw?t=1095 )
 Go to `MongoDB Compass`, update the information and see that in the collection of documents `articles` we have two articles.

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/4.png )

[(18:25)]( https://youtu.be/ZhkfsvGh-uw?t=1105 )
 Moreover, we can add a third article. And in it we can change the structure a little.

[(18:35)]( https://youtu.be/ZhkfsvGh-uw?t=1115 )
 Updating information. Pay attention - one more document has been added. There is already a distinctive line with the `author` field.

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/5.png )

[(20:15)]( https://youtu.be/ZhkfsvGh-uw?t=1215 )
 We can also select a certain model by its identifier. MongoDB identifiers are NOT numeric values. These are these string values. If we use the `find()` method, then such strings
values must be passed like this:

```php
$articles = Article::find('5fb2fd7169031f104e11a632');		
```

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/6.png )

[(20:45)]( https://youtu.be/ZhkfsvGh-uw?t=1245 )
 In the same way, you can create different kinds of filtering:

```php
$articles = Article::where('_id', '5fb2fd7169031f104e11a632')->get();		
```

[(21:45)]( https://youtu.be/ZhkfsvGh-uw?t=1305 )
 The `aticles()` method will implement a `One-To-Many` relationship.

`Category.php`:

```php
protected $collection = 'category';
protected $fillable = ['title'];

public function articles(){    
	return $this->hasMany('App\Article');        
}
```

We also create а relationship.

`Article.php`: 

```php
public function category(){    
	return $this->belongsTo('App\Category');        
}
```	
	
[(24:15)]( https://youtu.be/ZhkfsvGh-uw?t=1455 )
 Create `Category`.

`HomeController.php`:

```php
use App\Category;
...
Category::create([
	'title' => "PHP"            
]);

Category::create([
	'title' => "JS"            
]);
```

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/7.png )

[(24:50)]( https://youtu.be/ZhkfsvGh-uw?t=1490 )
 Let's create a new document in `articles`, BUT already define a link with `category`:

```php
$article = new Article(['title' => "title article", 'text' => "some text"]);
$category = Category::find("...");
$result = $category->articles()->save($article);
```

[(26:45)]( https://youtu.be/ZhkfsvGh-uw?t=1605 )
 Updating information in the browser. - There are NO errors. Go to MongoDB, update our `articles` collection. We see the last document, there is a `category_id` field.
This is the ID of the link plate.

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/8.png )

[(27:15)]( https://youtu.be/ZhkfsvGh-uw?t=1635 )
 The data has been saved - now we will display it. Let's select ALL records that have an associated `Category` model:

```php
$articles = Article::whereHas('category')->get();
```

[(28:10)]( https://youtu.be/ZhkfsvGh-uw?t=1690 )
 Save the changes, update the browser, and now, we see the model of just the same article that is tied to the corresponding category.

![screenshot of sample]( https://github.com/mslobodyanyuk/mongodb_webformyself/blob/master/public/images/9.png )

#### useful links:

WebForMySelf

[How to make Laravel framework friendly with MongoDb?]( https://www.youtube.com/watch?v=ZhkfsvGh-uw&ab_channel=WebForMySelf )

Tech On Tech	

[MongoDB Compass Install In Ubuntu]( https://www.youtube.com/watch?v=No_DXalfy60&ab_channel=TechOnTech )

Possible installation MongoDB errors in Ubuntu:

<https://stackoverflow.com/questions/26211671/failed-to-connect-to-127-0-0-127017-reason-errno111-connection-refused>

<https://stackoverflow.com/questions/53469608/mongo-db-mongodb-service-failed-status-14>

Download Compass 

<https://www.mongodb.com/try/download/compass>

MongoDB Compatibility

<https://docs.mongodb.com/drivers/php#compatibility>

Install MongoDB driver library

<https://packagist.org/packages/mongodb/mongodb>

<https://www.php.net/manual/en/mongodb.installation.manual.php>

Possible installation MongoDB driver errors:

<https://stackoverflow.com/questions/47272688/mongodb-mongodb-1-2-0-requires-ext-mongodb-1-3-0-the-requested-php-extensi>

Laravel MongoDB

<https://github.com/jenssegers/laravel-mongodb>

Possible installation Laravel with drivers of MongoDB errors:

<https://stackoverflow.com/questions/36117190/laravel-with-drivers-of-mongodb>