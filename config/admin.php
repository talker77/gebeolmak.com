<?php

// admin constants
$data = [
    // LOAD CONFIG FROM DATABASE OR FILE
    'config_driver' => env('CONFIG_DRIVER', 'file'),

    'title'           => 'gebeolmak.com',
    'short_title'     => 'GO',
    'creator'         => 'reklamus.net',
    'creator_link'    => 'http://reklamus.net',
    'version'         => 'v1.1.0',
    'max_upload_size' => 3024,
    // module status
    'modules_status' => [
        'advert'             => false,
        'banner'             => false,
        'blog'               => true,
        'coupon'             => false,
        'content_management' => true,
        'contact'            => true,
        'campaign'           => false,
        'e_bulten'           => true,
        'gallery'            => false,
        'order'              => false,
        'cargo'              => false,
        'product'            => false,
        'log'                => true,
        'sss'                => true,
        'setting'            => true,
        'reference'          => false,
        'user'               => true,
        'category'           => true,
        'our_team'           => false,
        'role'           => true,
        'forum'           => true,
    ],
    'use_album_gallery' => false,

    // multi lang
    'multi_lang'              => false,
    'multi_currency'          => false,
    'default_language'        => 1, // Ayar::LANG_TR
    'default_currency'        => 1, // Ayar::CURRENCY_TL
    'default_currency_prefix' => 'tl', // must be : tl,usd,eur
    'force_lang_currency'     => true, // para birimini dile göre varsayılanı seçmeye zorlar

    // DASHBOARD
    'dashboard' => [
        'show_products'      => false,
        'show_orders'        => false,
        'show_order_widgets' => false,
    ],

    // kuponlar kaç dakika geriye kadar  aktif-pasif kontrol edilsin
    'check_coupon_prev_minute'   => 5,
    'check_campaign_prev_minute' => 5,

    'iyzico' => [
        'order_url'  => env('IYZIPAY_ORDER_URL', 'https://sandbox-merchant.iyzipay.com/transactions/'),
        'api_key'    => env('IYZIPAY_API_KEY', 'DEFAULT_KEY'),
        'api_secret' => env('IYZIPAY_API_SECRET', 'DEFAULT_SECRET_KEY'),
        'base_url'   => env('IYZIPAY_BASE_URL', 'DEFAULT_BASE_URL'),
    ],
    // image quality %x if value is null image not be resized
    'image_quality' => [
        'advert'          => 70,
        'banner'          => 90,
        'blog'            => 80,
        'our_team'        => null,
        'category'        => null,
        'product'         => null,
        'product_image'   => null,
        'product_company' => null,
        'content'         => null,
        'reference'       => null,
        'coupon'          => null,
        'campaign'        => null,
        'gallery'         => null,
        'gallery_item'    => 60,
    ],
    // admin account
    'username' => 'admin@admin.com',
    'password' => 'adminadmin',

    'store_email'    => 'customer@example.com',
    'store_password' => 'adminadmin',

    // SITE CONFIG
    'site' => [
        'theme' => [
            'name'    => 'theme_1',
            'banner'  => 'banner_1.blade.php',
            'header'  => 'header_1.blade.php',
            'footer'  => 'footer_1.blade.php',
            'contact' => 'contact_1.blade.php',
        ],
        'menu' => [
            ['title' => 'Anasayfa', 'href' => '/', 'status' => true, 'order' => 1, 'module' => null],
            ['title' => 'Hakkımızda', 'href' => '/hakkimizda', 'status' => true, 'order' => 2, 'module' => null],
        ],
    ],
];

$data['menus'] = [
    0 => [
        'title' => 'Modüller',
        'user'  => [
            'icon'       => 'fa fa-user',
            'permission' => 'User@index',
            'title'      => 'users',
            'routeName'  => 'admin.users',
            'status'     => 'modules_status.user',
        ],
        'role' => [
            'icon'       => 'fa fa-user-times',
            'permission' => 'Role@list',
            'title'      => 'role_management',
            'routeName'  => 'admin.roles',
            'status'     => 'modules_status.role',
        ],
        'banner' => [
            'icon'       => 'fa fa-image',
            'permission' => 'Banner@list',
            'title'      => 'banner',
            'routeName'  => 'admin.banners',
            'status'     => 'modules_status.banner',
        ],
        'blog' => [
            'icon'       => 'fa fa-book',
            'permission' => 'Blog@index',
            'title'      => 'blog',
            'routeName'  => 'admin.blog',
            'status'     => 'modules_status.blog',
        ],
        'forum_comment' => [
            'icon'       => 'fa fa-comment',
            'permission' => 'ForumComment@index',
            'title'      => 'forum_comments',
            'routeName'  => 'admin.forum.comment',
            'status'     => 'modules_status.forum',
            'key' => 'forum-comment-pending',
            'extra' => '?status='. \App\Models\ForumComment::STATUS_PENDING
        ],
        'forum' => [
            'icon'       => 'fa fa-book',
            'permission' => 'Forum@index',
            'title'      => 'forum',
            'routeName'  => 'admin.forum',
            'status'     => 'modules_status.forum',
            'subs' => [
                [
                    'icon'       => 'fa fa-circle-o',
                    'permission' => 'Forum@index',
                    'title'      => 'forum_pending_approval',
                    'routeName'  => 'admin.forum',
                    'status'     => 'modules_status.forum',
                    'extra' => '?status='.\App\Models\Forum::STATUS_PENDING,
                    'key' => 'forum-pending'
                ],
                [
                    'icon'       => 'fa fa-circle-o',
                    'permission' => 'Forum@index',
                    'title'      => 'forum_approved',
                    'routeName'  => 'admin.forum',
                    'status'     => 'modules_status.forum',
                    'extra' => '?status='.\App\Models\Forum::STATUS_PUBLISHED,
                ],
                [
                    'icon'       => 'fa fa-circle-o',
                    'permission' => 'Forum@index',
                    'title'      => 'forum_denied',
                    'routeName'  => 'admin.forum',
                    'status'     => 'modules_status.forum',
                    'extra' => '?status='.\App\Models\Forum::STATUS_REJECTED,
                ]
            ]
        ],
        'advert' => [
            'icon'       => 'fa fa-percent',
            'permission' => 'Advert@index',
            'title'      => 'adverts',
            'routeName'  => 'admin.adverts.index',
            'status'     => 'modules_status.advert',
        ],
        'categories' => [
            'icon'       => 'fa fa-align-center',
            'permission' => 'Category@index',
            'title'      => 'categories',
            'routeName'  => 'admin.categories.index',
            'status'     => 'modules_status.category',
            'subs'       => [
                [
                    'icon'       => 'fa fa-circle-o',
                    'permission' => 'Category@index',
                    'title'      => 'blog_categories',
                    'routeName'  => 'admin.categories.index',
                    'status'     => 'modules.blog.category',
                    'extra'      => '?type=App\Models\Blog',
                ],
                [
                    'icon'       => 'fa fa-circle-o',
                    'permission' => 'Category@index',
                    'title'      => 'forum_categories',
                    'routeName'  => 'admin.categories.index',
                    'status'     => 'modules.blog.category',
                    'extra'      => '?type=App\Models\Forum',
                ],
            ],
        ],
        'content_management' => [
            'icon'       => 'fa fa-align-center',
            'permission' => 'Content@index',
            'title'      => 'content_management',
            'routeName'  => 'admin.content',
            'status'     => 'modules_status.content_management',
        ],
        'contact' => [
            'icon'       => 'fa fa-phone',
            'permission' => 'Contact@list',
            'title'      => 'contact',
            'routeName'  => 'admin.contact',
            'status'     => 'modules_status.contact',
        ],
        'e_bulten' => [
            'icon'       => 'fa fa-envelope',
            'permission' => 'EBulten@list',
            'title'      => 'e_bulten',
            'routeName'  => 'admin.ebulten',
            'status'     => 'modules_status.e_bulten',
        ],
        'references' => [
            'icon'       => 'fa fa-list-alt',
            'permission' => 'Referans@list',
            'title'      => 'references',
            'routeName'  => 'admin.reference',
            'status'     => 'modules_status.reference',
        ],
        'gallery' => [
            'icon'       => 'fa fa-camera',
            'permission' => 'FotoGallery@list',
            'title'      => 'gallery_management',
            'routeName'  => 'admin.gallery',
            'status'     => 'modules_status.gallery',
        ],
        'logs' => [
            'icon'       => 'fa fa-exclamation',
            'permission' => 'Log@list',
            'title'      => 'error_management',
            'routeName'  => 'admin.logs',
            'status'     => 'modules_status.log',
        ],
    ], 1 => [
        'title'    => 'Genel',
        'settings' => [
            'icon'       => 'fa fa-key',
            'permission' => 'Ayarlar@list',
            'title'      => 'configs',
            'routeName'  => 'admin.config.list',
            'status'     => 'modules_status.setting',
            'subs'       => [
                [
                    'icon'       => 'fa fa-key',
                    'permission' => 'Ayarlar@list',
                    'title'      => 'general',
                    'routeName'  => 'admin.config.list',
                    'status'     => 'modules_status.setting',
                ],
                [
                    'icon'       => 'fa fa-truck',
                    'permission' => 'Cargo@index',
                    'title'      => 'cargo',
                    'routeName'  => 'admin.cargo.index',
                    'status'     => 'modules.order.cargo',
                ],
            ],
        ],
        'sss' => [
            'icon'       => 'fa fa-info',
            'permission' => 'SSS@list',
            'title'      => 'faq',
            'routeName'  => 'admin.sss',
            'status'     => 'modules_status.sss',
        ],
    ],
];
$data['modules'] = [
    'product' => [
        'comment'           => true,
        'attribute'         => true, // product detail ex: color - green
        'category'          => true,
        'multiple_category' => false,
        'brand'             => true,
        'company'           => true,
        // features
        'feature'      => false,
        'variant'      => false,
        'gallery'      => true,
        'auto_code'    => false, // generate random auto code
        'qty'          => false,
        'image'        => true,
        'tag'          => false,
        'buying_price' => true,
        'prices'       => false,
        'cargo_price'  => true,
        // attributes
        'max_sub_attribute_count' => 10,
    ],
    'blog' => [
        'tag'      => true,
        'image'    => true,
        'language' => false,
        'category' => true,
        'images'   => true,
    ],
    'order' => [
        'iyzico_logs' => true,
        'cargo'       => false,
    ],
    'content' => [
        'images' => true,
    ],
    'contact' => [
        'columns'     => 'name|subject|email|phone|message',
        'fields'      => 'Başlık|Konu|Email|Telefon|Mesaj',
        'validations' => [
            'email'   => 'required|max:100',
            'name'    => 'required|max:100',
            'message' => 'required|max:250',
            'phone'   => 'required|max:30',
        ],
        'map'  => true,
        'form' => false,
    ],
];

return $data;
