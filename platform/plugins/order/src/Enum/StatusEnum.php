<?php

namespace Botble\Order\Enum;

use Botble\Base\Supports\Enum;
use Html;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusEnum extends Enum
{
    public const PENDING = 'pending';
    public const PROCESSING = 'processing';
    public const COMPLETED = 'completed';
    public const CANCELLED = 'cancelled';

    use SoftDeletes;

    /**
     * @var string
     */
    public static $langPath = 'plugins/order::enums.statuses';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::PENDING:
                return Html::tag('span', self::PENDING()->label(), ['class' => 'label-default status-label'])
                    ->toHtml();
            case self::PROCESSING:
                return Html::tag('span', self::PROCESSING()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::COMPLETED:
                return Html::tag('span', self::COMPLETED()->label(), ['class' => 'label-success status-label'])
                    ->toHtml();
            case self::CANCELLED:
                return Html::tag('span', self::CANCELLED()->label(), ['class' => 'label-primary  status-label'])
                    ->toHtml();
            default:
                return null;
        }
    }
}
