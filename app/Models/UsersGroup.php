<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersGroup extends Model
{
    //
   protected $table = 'users_group';
   protected $primaryKey = 'group_id';

   public function getUsersBelong($groupId)
    {
        return $this->where('group_id', '=', $groupId);
    }
}
