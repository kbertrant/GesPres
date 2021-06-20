<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/profile', 'HomeController@profile')->name('profile');

Route::get('centre', 'CentreController@centre')->name('centre.centre');
Route::get('/centre/get', 'CentreController@getcentrez')->name('centre.get');
Route::post('/centre/post/{id}', 'CentreController@updatecentre')->name('centre.post');
Route::post('/centre/saveupdate', 'CentreController@saveupdatecentre')->name('centre.saveupdate');
Route::get('/centre/update/{id}', 'CentreController@updatecentre')->name('centre.update');
Route::get('/centre/delete/{id}', 'CentreController@delete_centre')->name('centre.delete');
Route::post('centre/add', 'CentreController@addcentre');
Route::get('/centre/statistique','CentreController@centreStat')->name('centre.stat');
Route::get('/centre/getstat', 'CentreController@getCentreStat');

Route::get('ville', 'VilleController@ville')->name('ville.ville');
Route::post('ville/add', 'VilleController@addville')->name('ville.add');
Route::post('/ville/save', 'VilleController@saveville')->name('ville.save');
Route::get('/ville/get', 'VilleController@getville')->name('ville.get');
Route::post('/ville/post/{id}', 'VilleController@updateville')->name('ville.post');
Route::post('/ville/saveupdate', 'VilleController@saveupdateville')->name('ville.saveupdate');
Route::get('/ville/update/{id}', 'VilleController@updateville')->name('ville.update');
Route::get('/ville/delete/{id}', 'VilleController@delete_ville')->name('ville.delete');

Route::get('med', 'MedicamentController@med')->name('med.med');
Route::post('med/add', 'MedicamentController@addmed');

Route::get('person', 'PersonnelController@person')->name('person');
Route::post('/person/save', 'PersonnelController@saveperson')->name('person.save');
Route::get('/person/get', 'PersonnelController@getperson')->name('person.get');
Route::post('/person/post', 'PersonnelController@updateperson')->name('person.post');
Route::post('/person/saveupdate', 'PersonnelController@saveupdateperson')->name('person.saveupdate');
Route::get('/person/update/{id}', 'PersonnelController@updateperson')->name('person.update');
Route::get('/person/delete/{id}', 'PersonnelController@delete_person')->name('person.delete');
Route::get('/getmedecin', 'PersonnelController@getmedecin')->name('getmedecin');

Route::get('medicam', 'MedicamentController@medicam')->name('medicam');
Route::post('/medicam/save', 'MedicamentController@savemedicam')->name('medicam.save');
Route::get('/medicam/get', 'MedicamentController@getmedicam')->name('medicam.get');
Route::post('/medicam/post/{id}', 'MedicamentController@updatemedicam')->name('medicam.post');
Route::post('/medicam/saveupdate', 'MedicamentController@saveupdatemedicam')->name('medicam.saveupdate');
Route::get('/medicam/update/{id}', 'MedicamentController@updatemedicam')->name('medicam.update');
Route::get('/medicam/delete/{id}', 'MedicamentController@delete_medicam')->name('medicam.delete');

Route::get('/user', 'UserController@user')->name('user');
Route::post('/user/save', 'UserController@saveuser')->name('user.save');
Route::get('/user/get', 'UserController@getUser')->name('user.get');
Route::post('/user/post', 'UserController@saveupdateuser')->name('user.post');
Route::get('/user/update/{id}', 'UserController@updateuser')->name('user.update');
Route::get('/user/delete/{id}', 'UserController@delete_user')->name('user.delete');

Route::get('ordonan', 'OrdonnanceController@ordonan')->name('ordonan');
Route::post('/ordonan/save', 'OrdonnanceController@saveordonan')->name('ordonan.save');
Route::get('/ordonan/get', 'OrdonnanceController@getordonan')->name('ordonan.get');
Route::get('/ordonan/getall', 'OrdonnanceController@getallordonan')->name('ordonan.getall');
Route::post('/ordonan/update/{id}', 'OrdonnanceController@updateordonan')->name('ordonan.post');
Route::post('/ordonan/saveupdate', 'OrdonnanceController@saveupdateordonan')->name('ordonan.saveupdate');
Route::get('/ordonan/update/{id}', 'OrdonnanceController@updateordonan')->name('ordonan.update');
Route::get('/ordonan/delete/{id}', 'OrdonnanceController@delete_ordonan')->name('ordonan.delete');
Route::get('/ordonan/show/{id}', 'OrdonnanceController@showordonan')->name('ordonan.show');
Route::get('/autoperson', 'OrdonnanceController@autoPerson')->name('autoperson');
Route::get('/automedicam', 'OrdonnanceController@autoMedicam')->name('automedicam');

Route::get('/getinfos', 'OrdonnanceController@getinfos');

Route::get('roleuser', 'UserController@roleuser')->name('roleuser');
Route::post('saveroleuser', 'UserController@saveroleuser')->name('saveroleuser');
Route::get('/getroleuser', 'UserController@getroleuser')->name('getroleuser');

Route::get('medicamplusvendus', 'StatController@medicamplusvendus')->name('medicamplusvendus');

Route::get('emprunt', 'LunetteController@emprunt')->name('emprunt');
Route::post('/emprunt/save', 'LunetteController@saveemprunt')->name('emprunt.save');
Route::get('/emprunt/get', 'LunetteController@getemprunt')->name('emprunt.get');
Route::get('/emprunt/getall', 'LunetteController@getallemprunt')->name('emprunt.getall');
Route::post('/emprunt/post/{id}', 'LunetteController@updateemprunt')->name('emprunt.post');
Route::post('/emprunt/saveupdate', 'LunetteController@saveupdateemprunt')->name('emprunt.saveupdate');
Route::get('/emprunt/update/{id}', 'LunetteController@updateemprunt')->name('emprunt.update');
Route::get('/emprunt/delete/{id}', 'LunetteController@delete_emprunt')->name('emprunt.delete');
Route::get('/emprunt/show/{id}', 'LunetteController@showemprunt')->name('emprunt.show');