<?php


namespace App\Repositories;


use App\Constants\AppConstants;
use App\Entities\User;
use App\Events\Staff\NewStaffCreated;
use App\Interfaces\StaffsInterface;
use Illuminate\Support\Facades\DB;

class StaffsRepository extends BaseRepository implements StaffsInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes){
        try{
            DB::beginTransaction();
            /* @var User $staff */
            $staff                  = $this->model->create($attributes);
            event(new NewStaffCreated($staff));
            DB::commit();
            return $staff;
        } catch(\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }

    public function getStaffs()
    {
        return $this->model->where('role' , AppConstants::ROLE_STAFF)->orderByDesc('id')->paginate(15);
    }


    public function findByEmail(string $email)
    {
        return $this->model->where('email' , $email)->first();
    }
}
