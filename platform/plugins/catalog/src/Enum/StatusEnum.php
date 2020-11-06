<?php

namespace Botble\Catalog\Enum;

use Botble\Base\Supports\Enum;
use Html;

class StatusEnum extends Enum
{
    public const IN_STOCK = 'in stock';
    public const DRAFT = 'draft';
    public const OUT_STOCK = 'out stock';

    /**
     * @var string
     */
    public static $langPath = 'plugins/catalog::enums.statuses';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::IN_STOCK:
                return Html::tag('span', self::IN_STOCK()->label(), ['class' => 'label-success status-label'])
                    ->toHtml();
            case self::OUT_STOCK:
                return Html::tag('span', self::OUT_STOCK()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::DRAFT:
                return Html::tag('span', self::DRAFT()->label(), ['class' => 'label-default status-label'])
                    ->toHtml();
            default:
                return null;
        }
    }
}
