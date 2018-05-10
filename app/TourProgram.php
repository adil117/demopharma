<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class TourProgram
 *
 * @package App
 * @property enum $month
 * @property string $select_date
 * @property string $medical_representative_name
 * @property string $area
 * @property string $modification
 * @property text $remarks
 * @property string $work_with_manager
*/
class TourProgram extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['month', 'select_date', 'medical_representative_name', 'area', 'modification', 'remarks', 'work_with_manager'];
    public static $searchable = [
        'month',
        'select_date',
        'medical_representative_name',
        'area',
        'modification',
        'remarks',
        'work_with_manager',
    ];
    
    public static function boot()
    {
        parent::boot();

        TourProgram::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_month = ["Select Month" => "Select Month", "January" => "January", "February" => "February", "March" => "March", "April" => "April", "May" => "May", "June" => "June", "July" => "July", "August" => "August", "September" => "September", "October" => "October", "November" => "November", "December" => "December"];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setSelectDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['select_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['select_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getSelectDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
}
