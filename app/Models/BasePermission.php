<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasePermission extends Model
{
    use HasFactory;

    /**
     * private const MODEL ='Category';
     * Index/GET/SHOW    |
     *      $this->authorize(self::MODEL.'-viewAny');
     * Create/Store      |
     *      $this->authorize(self::MODEL.'-store');
     * Edit/Update       |
     *      $this->authorize(self::MODEL.'-update');
     * Delete            |
     *      $this->authorize(self::MODEL.'-delete');
     */

    const MODELS = [
        'Admin', #AdminController
        'Client', #ClientsController
        'Department', #DepartmentsController
        'Permission', #PermissionsController
        'Position', #PositionsController
        'Problem', #ProductsController
        # end reports
    ];

    protected $table = 'base_permissions';
    protected $fillable = ['admin_id', 'position_id', 'model_class', 'permission'];

    public $timestamps = false;
}
