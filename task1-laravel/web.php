<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;


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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',function (){

    $tasks = Task::orderby('created_at','desc')->get();

    return view('tasks',[
        'tasks'=>$tasks
    ]);
});
//Add a new task

Route::post('/task',function (Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
        ]);
        if ($validator ->fails()) {
            return redirect('/') ->withInput() ->withErrors($validator);
        }
        $task = new Task;
        $task ->name = $request->name;
        $task->save();
        return redirect('/');
});
//Delete a task
Route::delete('/task/{id}',function ($id){
//                KIEM TRA LOI
////        dd(Task::find($id));

        Task::find($id)->delete();
        return redirect('/');
})->name('task.delete');


