<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\UserInputRequest;
use App\Models\DBConnection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class TasksController extends Controller
{
    protected $products = [
        1 => 10.12,
        2 => 25.56,
        3 => 15.00,
        4 => 45.00,
        5 => 65.10,
        6 => 49.60,
        7 => 80.89,
        8 => 67.13,
        9 => 9.12,
    ];

    public function thresholdFilter(Request $request)
    {
        $threshold = $request->input('threshold') ?? "45.44";
        $filterProduct = array_filter($this->products, function ($value) use ($threshold) {
            return $value > $threshold;
        });

        return $filterProduct;
    }

    public function sumFiltered(Request $request)
    {
        $sum = floatval(0.00);
        $filteredArray = $this->thresholdFilter($request);
        $sum = array_reduce($filteredArray, function ($carry, $item) {
            return $carry + floatval($item);
        }, 0.0);

        return $sum;
    }

    public function setDatabaseConfig(Request $request)
    {
        // Set the database connection configuration values
        $driver = $request->input('driver') ?? 'mysql';
        $host = $request->input('host') ?? 'localhost';
        $database = $request->input('database') ?? 'practise_dbase';
        $username = $request->input('username') ?? 'root';
        $password = $request->input('password') ?? '';

        return new DBConnection($driver, $host, $database, $username, $password);
    }

    public function checkConn(Request $request)
    {
        $conn = $this->setDatabaseConfig($request);
        return $conn->executeQuery("select * from users limit 100");
    }
    public function userInputPosts(UserInputRequest $request)
    {
        try {
            dd($request->validated());
            // handle the filter requests values here
        } catch (ValidationException $ex) {
            return ResponseHelper::responseHandling($data = [], $ex->errors(), Response::HTTP_BAD_REQUEST);
        } catch (Exception $ex) {
            return ResponseHelper::responseHandling($data = [], $ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
