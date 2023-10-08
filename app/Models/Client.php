<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes, HasRoles;

    const TYPE_CLIENT = 'client';
    const TYPE_SUPPLIER = 'supplier';
    const TYPE_CLIENT_SUPPLIER = 'client_supplier';

    const EVENTS = [
      0 => 'client_created',
      1 => 'client_updated',
      2 => 'client_deleted'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $appends = ['display_name','full_address','profile_pic'];

    protected $fillable = [

        'email',
        'username',
        'name_ar',
        'name_en',
        'code',
        'id_secondary',
        'phone',
        'fax',
        'start_date',
        'commercial_registration_no',
        'tax_registration_no',
        'tax_file_no',
        'tax_office',
        'type',
        'country',
        'governorate',
        'city',
        'district',
        'post_number',
        'building_number',
        'street_name',
        'active',
        'password',
        'active',
        'image',
        'client_id',
        'client_secret',
        'client_customer_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDisplayNameAttribute()
    {
        if (App::isLocale('ar')) {
            return "{$this->name_ar}";
        }else{
            return "{$this->name_en}";
        }
    }

    public function getFullAddressAttribute()
    {
        return $this->country." ".$this->governorate." ".$this->city." ".$this->district." ".$this->street_name." ".$this->building_number." ";
    }

    public function getProfilePicAttribute()
    {
        if(!$this->image){
            return url('images/profile.jpg');
        }
        return asset("storage/$this->image");
    }

    public function balanceAmount()
    {
        return $this->hasMany(ClientBalanceSheet::class, 'client_id', 'id');
    }

    public function Sales()
    {
        return $this->hasMany(InvoiceHeader::class, 'client_id', 'id')->where('invoice_headers.status','approved');
    }

    public function Purshases()
    {
        return $this->hasMany(PurchaseHeader::class, 'supplier_id', 'id')->where('purchase_headers.status','approved');
    }

    public function guardName(){
        return 'client';
    }

    public function permissions()
    {
        return $this->hasMany(ClientPermission::class,'main_client_id');
    }

    public function procedures()
    {
        return $this->hasMany(Problem::class)->where('type','procedure');
    }

    public function cases()
    {
        return $this->hasMany(Problem::class)->where('type','case');
    }
    

    public function getProcedureStock() {
        return $this->procedures()
            ->with(['ProblemProcedure']) // Remove the $query argument here
            ->get()
            ->flatMap(function ($problem) {
                return $problem->ProblemProcedure->map(function ($procedure) {
                    return $procedure->client_payment - $procedure->total_cost;
                });
            })
            ->sum();
    }


    public function getCaseStock() {
        return $this->cases()
            ->with(['ProblemProcedure']) // Remove the $query argument here
            ->get()
            ->flatMap(function ($problem) {
                return $problem->ProblemProcedure->map(function ($procedure) {
                    return $procedure->client_payment - $procedure->total_cost;
                });
            })
            ->sum();
    }




     

}
