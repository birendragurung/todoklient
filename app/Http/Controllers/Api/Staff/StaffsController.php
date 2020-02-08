<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateStaffRequest;
use App\Http\Requests\Admin\DeleteStaffRequest;
use App\Http\Requests\Admin\UpdateStaffRequest;
use App\Interfaces\StaffsInterface;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    use PaginationTrait;
    /**
     * @var \App\Interfaces\StaffsInterface
     */
    private $staffs;

    public function __construct(StaffsInterface $staffs)
    {
        $this->staffs = $staffs;
    }

    public function index(Request $request)
    {
        return $this->staffs->list();
    }

    public function store(CreateStaffRequest $request)
    {
        return $this->staffs->create($request->all());
    }

    public function show(int $id)
    {
        return $this->responseOk($this->staffs->findById($id));
    }

    public function update(UpdateStaffRequest $request, int $id)
    {
        return $this->responseOk($this->staffs->updateById($id, $request->all()));
    }

    public function delete(DeleteStaffRequest $request, int $id)
    {
        return $this->responseOk($this->staffs->deleteById($id));
    }
}
