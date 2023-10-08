<?php

namespace App\Rules;
use App\Models\Staff;
use Illuminate\Contracts\Validation\Rule;

class CheckFingerPrint implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $branch_id = request()->get('branch_id');
        $segments = request()->segments(3);
        
        if(!empty($segments[2])){

            $id = $segments[2];
            $count = Staff::where($attribute,$value)
            ->where('branch_id',$branch_id)
            ->where('id','!=',$id)
            ->count();
        }else{
            $count = Staff::where($attribute,$value)
            ->where('branch_id',$branch_id)
            ->count();
        }
        if(!$count) return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.finger_print_id');
    }
}
