<?php
use Freshwork\ChileanBundle\Laravel\Facades\Rut;

Route::get('test', function (Illuminate\Http\Request $request) {
    //return Rut::parse('12345678-5')->isValid() ? 'bien' : 'mal'; //true
});

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

#USER
Route::get('user/{user_id}/evaluation/{evaluation_id}', 'UserController@viewEvaluation')->name('user.evaluation');
Route::post('user/question/answer', 'UserController@answerEvaluation')->name('user.evaluation.answer');
Route::post('users/evaluation/{evaluation_id}/send', 'UserController@sendEvaluation')->name('user.evaluation.send');
Route::resource('user', 'UserController');


Route::get('export/evaluation/{evaluation_id}', 'ExportController')->name('export.evaluation');
