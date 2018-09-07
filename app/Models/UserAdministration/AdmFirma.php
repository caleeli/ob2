<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;

class AdmFirma extends Model
{

    use SoftDeletes,
        Notifiable,
        SaveUserTrait;

    protected $table = 'adm_firmas';

}
