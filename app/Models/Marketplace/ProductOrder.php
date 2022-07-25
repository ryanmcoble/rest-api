<?php

namespace App\Models\Marketplace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_orders';

    protected $fillable = [
        'seller_id',
        'buyer_id',
        'product_id',
        'product_price_id',
        'discount_code_id',
        'status',
        'next_payment_at'
    ];

    /**
     * User that is selling the product in the order
     *
     * @return void
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * User that is buying the product in the order
     *
     * @return void
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Product that was sold with the order
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Payment method used on the order
     *
     * @return void
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentProcessor::class, 'payment_method_type_id');
    }

    /**
     * The discount code applied to the order
     *
     * @return void
     */
    public function discountCode()
    {
        return $this->hasOne(DiscountCode::class, 'discount_code_id');
    }
}
