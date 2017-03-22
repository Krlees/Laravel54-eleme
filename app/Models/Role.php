<?php
namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = "roles";

    protected $foreignKey = 'role_id';

    protected $fillable = [
        'name','display_name','description'
    ];

}