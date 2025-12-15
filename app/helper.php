<?php

use App\Models\Category;
use App\Models\Colors;
use App\Models\Variation;
use App\Models\ProductStocks;
use App\Models\Page;
use Rakibhstu\Banglanumber\NumberToBangla;

if (!function_exists('featured_categories')) {
    function featured_categories()
    {
        $categories = Category::where(['is_menu_active' => 1, 'is_active' => 1])->orderBy('menu_position', 'ASC')->limit(8)->get();
        return $categories;
    }
}

if (!function_exists('all_cateegories')) {
    function all_cateegories()
    {
        $all_categories = Category::orderBy('title', 'ASC')->get(['title', 'id']);
        return $all_categories;

    }
}

if (!function_exists('business_info')) {
    function business_info()
    {
        $business = App\Models\Setting::find(1);
        return $business;
    }
}

if (!function_exists('color_info')) {
    function color_info($id)
    {
        $info = Colors::find($id);
        return $info;
    }
}

if (!function_exists('variation_info')) {
    function variation_info($id)
    {
        $info = Variation::find($id);
        return $info;
    }
}

if (!function_exists('single_variation_info')) {
    function single_variation_info($variant_id, $product_id)
    {
        $info = ProductStocks::where('variant', $variant_id)->where('product_id', $product_id)->where('is_active', 1)->get(['id', 'variant', 'variant_output']);
        return $info;
    }
}

if (!function_exists('variation_stock_info')) {
    function variation_stock_info($id)
    {
        $info = ProductStocks::find($id);
        return $info;
    }
}

if (!function_exists('other_pages')) {
    function other_pages()
    {
        $info = Page::get(['id', 'name']);
        return $info;
    }
}

if (!function_exists('bnConv')) {
    function bnConv($type = 'bnNum', $number = 0)
    {
        // If the locale is Bangla, you can still format numbers with commas
        if (session()->get('locale') == 'bn') {
            switch ($type) {
                case 'bnNum':
                case 'bnComNum': // you can treat comma formatting same way
                    // Format with commas (1,234,567)
                    return number_format($number);
                case 'bnMoney':
                    // Add currency symbol
                    return '৳' . number_format($number, 2);
                case 'bnMonth':
                case 'bnWord':
                    // For month or word, just return as-is (or translate later if needed)
                    return $number;
                default:
                    return $number;
            }
        }

        // If locale is not Bangla, return normal number
        return $number;
    }
}

if (!function_exists('__translate')) {
    function __translate($en, $bn)
    {
        if (session()->get('locale') == 'bn') {
            return $bn ?? $en;
        } else {
            return $en;
        }
    }
}

if (!function_exists('__currency')) {
    function __currency()
    {
        if (session()->get('locale') == 'bn') {
            return '৳' ?? 'Tk';
        } else {
            return 'Tk';
        }
    }
}
if (!function_exists('humanReadableFilesize')) {
    /**
     * Format file size to human-readable format.
     *
     * @param int $bytes
     * @param int $decimals
     * @return string
     */
    function humanReadableFilesize($bytes, $decimals = 2)
    {
        $size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}

if (!function_exists('get_youtube_video_id')) {
    function get_youtube_video_id($url, $key)
    {
        $query_str = parse_url($url, PHP_URL_QUERY);
        parse_str($query_str, $query_params);

        return $query_params[$key] ?? '';
    }
}







