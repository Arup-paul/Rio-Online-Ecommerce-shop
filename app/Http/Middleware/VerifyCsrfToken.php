<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admin/check-current-pwd","admin/update_section_status","admin/update_category_status","admin/append_categories_level","admin/update_product_status","admin/update_attribute_status","admin/update_image_status","admin/update_brand_status","admin/update_banner_status",
    ];
}
