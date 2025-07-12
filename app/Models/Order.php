<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'table_number',
        'total',
        'status',
        'notes'
    ];

    protected $casts = [
        'total' => 'integer',
        'table_number' => 'integer'
    ];

    // Constants for order status
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    // Get all status options
    public static function getStatusList()
    {
        return [
            self::STATUS_PENDING => 'Menunggu',
            self::STATUS_PROCESSING => 'Diproses',
            self::STATUS_COMPLETED => 'Selesai',
            self::STATUS_CANCELLED => 'Dibatalkan'
        ];
    }

    // Get status label
    public function getStatusLabelAttribute()
    {
        $statusList = self::getStatusList();
        return $statusList[$this->status] ?? $this->status;
    }

    // Format total with Indonesian currency
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    // Relationship with OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scope for pending orders
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    // Scope for processing orders
    public function scopeProcessing($query)
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    // Scope for completed orders
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    // Scope for today's orders
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    // Get order summary for dashboard
    public static function getOrderSummary()
    {
        return [
            'total_orders' => self::count(),
            'pending_orders' => self::pending()->count(),
            'processing_orders' => self::processing()->count(),
            'completed_orders' => self::completed()->count(),
            'today_orders' => self::today()->count(),
            'today_revenue' => self::today()->sum('total')
        ];
    }
}
