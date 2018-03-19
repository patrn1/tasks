<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TasksController extends Controller
{
    /**
     * Get the task.
     *
     * @param  string $id
     * @return array
     */
    public function get($id)
    {
        return [
            'id'    => $id,
            'title' => "Задача $id",
            'date'  => date(
                'd.m.Y H:i', strtotime("today + $id hours")
            ),
            'author' => "Автор $id",
            'status' => "Статус $id",
            'description' => "Описание $id",
        ];
    }

    /**
     * Get the tasks list.
     *
     * @return array
     */
    public function getAll()
    {
        if ($tasks = Cache::get('tasks')) {
            return $tasks;
        } else {
            for ($id = 1; $id <= 1000; $id++) {
                $tasks[] = [
                    'id'    => $id,
                    'title' => "Задача $id",
                    'date'  => date(
                        'd.m.Y H:i',
                        strtotime("today + $id hours")
                    ),
                ];
            }
            Cache::forever('tasks', $tasks);
            return $tasks;
        }
    }
}
