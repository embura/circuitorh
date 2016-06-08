<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sintegra extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sintegras';

    /**
     * Campos serão alterados para data
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Pode ser atribuido em massa;
     */
    protected $fillable = [
        'id_usuario',
        'cnpj',
        'resultado_json',
    ];

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsToMany('App\User');
    }

}
