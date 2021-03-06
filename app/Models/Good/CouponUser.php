<?php

namespace App\Models\Good;

use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    // 用户优惠券
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'coupon_user';

    // 不可以批量赋值的字段，为空则表示都可以
    protected $guarded = [];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $hidden = [];
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = true;

    // 关联商品评价
    public function coupon()
    {
        return $this->belongsTo('\App\Models\Good\Coupon','yhq_id','id');
    }
}
