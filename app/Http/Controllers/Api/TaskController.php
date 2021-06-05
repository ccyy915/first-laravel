<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{


    private function makeJson($status, $data = null, $msg = null)
    {
        return response()->json(['status' => $status, 'data' => $data, 'message' => $msg])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('enabled', true)->get();
        return $this->makeJson(1, $tasks);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['title', 'salary', 'desc', 'enabled']);
        $task = Task::create($data);
        if(isset($task)){
            return $this->makeJson(1, $task);
        }else{
            return $this->makeJson(0, null, 'Failed to store.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        if(isset($task)){
            return $this->makeJson(1, $task);
        }else{
            return $this->makeJson(0, null, "Can't find data.");
        }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if(isset($task)){
            $row = $task->update($request->only(['title', 'salary', 'desc', 'enabled']));
            if($row == 1){
                return $this->makeJson(1, $task);
            }else{
                return $this->makeJson(0, null, "Failed to update.");
            }
            
        }else{
            return $this->makeJson(0, null, "Failed to update. Can't find data.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $row = $task->delete();
        if(isset($task)){
            return $this->makeJson(1, null, 'Success to delete.');
        }else{
            return $this->makeJson(0, null, "Failed to delete.");
        }
    }
}
