<?php

namespace App\Models;

use Exception;

/**
 * SaveUser
 *
 */
trait SaveUserTrait
{

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            try {
                $header = request()->header('Authorization');
                list($auth, $user) = explode(' ', $header);
                $model->usuario_abm_id = $user;
            } catch (Exception $e) {
                error_log('Unable to obtain authorization: ' . $e->getMessage());
            }
        });
        static::deleting(function ($model) {
            try {
                $header = request()->header('Authorization');
                list($auth, $user) = explode(' ', $header);
                $model->usuario_abm_id = $user;
                $model->save();
            } catch (Exception $e) {
                error_log('Unable to obtain authorization: ' . $e->getMessage());
            }
        });
    }

    public function usuarioAbm()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }
}
