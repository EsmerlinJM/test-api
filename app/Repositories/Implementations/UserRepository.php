<?php

namespace App\Repositories\Implementations;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Core\Repository;

class UserRepository extends Repository implements IUserRepository {
   
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function getContactsInformationPaginated($request) {
        $sort = $request->sort ? $request->sort : 'created_at';
        $order = $request->order ? $request->order : 'asc';
        $limit = $request->limit ? $request->limit : 10;
        $query = $request->search ? $request->search : '';
        
        $contacts = $this->model->scopeContactsInformations($query, $sort, $order)->map(function ($contacts) {
            return collect($contacts->toArray())
                ->all();
        });
        
        return [
            'total' => $this->model->count('id'),
            'rows' => $contacts->paginate($limit)
        ];
    }

    public function createMany($input, $model) {
        $query = [];

        foreach ($input['phones'] as $key => $value) {
            $query[] = $model->phones()->create(['phone' => $value]);
            $this->commit($query);
        }

        foreach ($input['addresses'] as $key => $value) {
           $query[] = $model->addresses()->create(['address' => $value]);
           $this->commit($query);
        }
    }


}