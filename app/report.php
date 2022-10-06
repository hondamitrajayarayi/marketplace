<?php

namespace App;


namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model

{
    
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'oracle';
    protected $fillable = [
        'id', 'item_id', 'branch_id','price','qty','user_id','create_date','status',
    ];

    //memberi tahu bahwa table yang dipilih dengan nama mst_biro_jasa
	protected $table = 'log_update_mp';

    //memberi tahu bahwa primarykeynya adalah biro_id
    protected $primaryKey = 'id';

    //baca increment
    public $incrementing = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'item_id', 'remember_token',
    ];

    public $timestamps;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'item_id_id' => 'datetime',
    ];

    protected $dateFormat = 'U';
     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
