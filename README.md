<h4 align="center">
    <br><br>
    <p align="center">
      <a href="#-about">About</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-technologies">Technologies</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-how-to-run-the-project">Run</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-info">Info</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-changelog">Changelog</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-license">License</a>
  </p>
</h4>

## 🔖 About
Api RESTful, made with codeigniter 4 framework. Allows you to make a CRUD and validation data using as an example users.

## 🚀 Technologies

- [PHP](https://php.net/)
- [CodeIgniter](https://codeigniter.com/)

## 🏁 How to run the project

#### Clone the repository

```bash
git clone https://github.com/rafinhaa/ci4-api-validation.git
cd ci4-api-validation
```

#### Install dependencies

```bash
composer install
```

#### Create and edit env file

```bash
cp env .env
vi .env
```

#### Set permissions to writable folder

```bash
chmod -R 777 writable
```

#### Execute migrations

```bash
php spark migrate
```

#### Execute seeders

```bash
php spark db:seed Users
```

## ℹ️ Info

#### Api usage
```php
$routes->group("api", ["namespace" => "App\Controllers\Api"] , function($routes){
	$routes->group("users", function($routes){
	   $routes->get(   "list",         "ApiController::listUsers");
	   $routes->post(  "add",          "ApiController::addUser");
	   $routes->get(   "single/(:num)","ApiController::singleUser/$1");
	   $routes->put(   "update/(:num)","ApiController::updateUser/$1");
	   $routes->delete("delete/(:num)","ApiController::deleteUser/$1");
	});	 
});
```

Get all users. Method: GET
http://localhost:8080/api/users/list

Get single user. Method: GET
http://localhost:8080/api/users/single/2

Create an user. POST multipart with username and email.
http://localhost:8080/api/users/add

Update an user. Verb HTTP PUT with name and email.
http://localhost:8080/api/users/update/4
```json
{
	"username": "newuser",
	"email":    "newuser@job.com"
}
```

Delete an user. Verb HTTP DELETE.
http://localhost:8080/api/users/delete/4

## 📄 Changelog

[See here](docs/changelog.md)

## 📝 License

[MIT](LICENSE)

**Free Software, Hell Yeah!**
