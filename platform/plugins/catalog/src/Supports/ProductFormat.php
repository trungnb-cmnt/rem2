<?php

namespace Botble\Catalog\Supports;

class ProductFormat
{
    /**
     * @var array
     */
    protected static $formats = [
        ''        => [
            'key'  => '',
            'icon' => null,
            'name' => 'Default',
        ],
        'gallery' => [
            'key'  => 'gallery',
            'icon' => 'fa fa-image',
            'name' => 'Gallery',
        ],
        'video'   => [
            'key'  => 'video',
            'icon' => 'fa fa-camera',
            'name' => 'Video',
        ],
    ];

    /**
     * @param array $formats
     * @return void
     * @author Sang Nguyen
     * @since 16-09-2016
     */
    public static function registerProductFormat(array $formats = [])
    {
        foreach ($formats as $key => $format) {
            self::$formats[$key] = $format;
        }
    }

    /**
     * @param bool $convert_to_list
     * @return array
     * @author Sang Nguyen
     * @since 16-09-2016
     */
    public static function getProductFormats($convert_to_list = false)
    {
        if ($convert_to_list) {
            $results = [];
            foreach (self::$formats as $key => $item) {
                $results[] = [
                    $key,
                    $item['name'],
                ];
            }
            return $results;
        }

        return self::$formats;
    }
}
