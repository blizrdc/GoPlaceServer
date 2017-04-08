<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	// 根据userid获得所需用户的信息(Many To Many)
    public function getBelongsByUseridMTM($releted, $table, $foreignKey, $foreignKeyValue, $relatedKey, $withPivot) {
		return $this->find($foreignKeyValue)->belongsToMany($releted,$table,$foreignKey,$relatedKey)->withPivot($withPivot);
    }
    
    // 根据userid获得所需用户的信息(One To One)
    public function getHasOneByUseridOTO($releted, $foreignKey, $foreignKeyValue, $localKey) {
    	return $this->find($foreignKeyValue)->hasOne($releted, $foreignKey, $localKey);
    }
}
