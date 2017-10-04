<?php

use App\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => 'web'], function () {

    /**
     * 顯示所有任務
     */
     Route::get('/', function () {
        $tasks = Task::orderBy('created_at', 'asc')->get();
    
        return view('tasks', [
            'tasks' => $tasks
        ]);
    });
    
    /**
     * 增加新的任務
     */
     Route::post('/task', function (Request $request) {
        // 驗證輸入
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
    
        // 建立該任務...
        $task = new Task;
        $task->name = $request->name;
        $task->save();
        return redirect('/');
    
    });
    

    /**
     * 刪除任務
     */
    Route::delete('/task/{task}', function (Task $task) {
        //
    });
});