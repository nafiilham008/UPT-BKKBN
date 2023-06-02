<?php

return [
    /**
     * If any input file(image) as default will used options below.
     */
    'image' => [
        /**
         * Path for store the image.
         *
         * avaiable options:
         * 1. public
         * 2. storage
         */
        'path' => 'storage',

        /**
         * Will used if image is nullable and default value is null.
         */
        'default' => 'https://via.placeholder.com/350?text=No+Image+Avaiable',

        /**
         * Crop the uploaded image using intervention image.
         */
        'crop' => true,

        /**
         * When set to true the uploaded image aspect ratio will still original.
         */
        'aspect_ratio' => true,

        /**
         * Crop image size.
         */
        'width' => 500,
        'height' => 500,
    ],

    'format' => [
        /**
         * Will used to first year on select, if any column type year.
         */
        'first_year' => 1900,

        /**
         * If any date column type will cast and display used this format, but for input date still will used Y-m-d format.
         *
         * another most common format:
         * - M d Y
         * - d F Y
         * - Y m d
         */
        'date' => 'd/m/Y',

        /**
         * If any input type month will cast and display used this format.
         */
        'month' => 'm/Y',

        /**
         * If any input type time will cast and display used this format.
         */
        'time' => 'H:i',

        /**
         * If any datetime column type or datetime-local on input, will cast and display used this format.
         */
        'datetime' => 'd/m/Y H:i',

        /**
         * Limit string on index view for any column type text or longtext.
         */
        'limit_text' => 100,
    ],

    /**
     * It will used for generator to manage and showing menus on sidebar views.
     *
     * Example:
     * [
     *   'header' => 'Main',
     *
     *   // All permissions in menus[] and submenus[]
     *   'permissions' => ['test view'],
     *
     *   menus' => [
     *       [
     *          'title' => 'Main Data',
     *          'icon' => '<i class="bi bi-collection-fill"></i>',
     *          'route' => null,
     *
     *          // permission always null when isset submenus
     *          'permission' => null,
     *
     *          // All permissions on submenus[] and will empty[] when submenus equals to []
     *          'permissions' => ['test view'],
     *
     *          'submenus' => [
     *                 [
     *                     'title' => 'Tests',
     *                     'route' => '/tests',
     *                     'permission' => 'test view'
     *                  ]
     *               ],
     *           ],
     *       ],
     *  ],
     *
     * This code below always changes when you use a generator and maybe you must lint or format the code.
     */
    'sidebars' => [
        [
            'header' => 'Users',
            'permissions' => [
                'user view',
                'role & permission view'
            ],
            'menus' => [
                [
                    'title' => 'User Menu',
                    'icon' => '<i class="bi bi-people-fill"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'user view',
                        'role & permission view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Users',
                            'route' => '/users',
                            'permission' => 'user view'
                        ],
                        [
                            'title' => 'Roles & Permissions',
                            'route' => '/roles',
                            'permission' => 'role & permission view'
                        ]
                    ]
                ]
            ]
        ],
        [
            'header' => 'Main Content',
            'permissions' => [
                'content view',
                'highlight view',
            ],
            'menus' => [
                [
                    'title' => 'Content',
                    'icon' => '<i class="bi bi-file-post-fill"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'content view',
                        'highlight view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Post Content',
                            'route' => '/posts',
                            'permission' => 'content view'
                        ],
                        [
                            'title' => 'Banner Setting',
                            'route' => '/highlights',
                            'permission' => 'highlight view'
                        ]
                    ]
                ],
            ]
        ],
        [
            'header' => 'Main Menu',
            'permissions' => [
                'historical view',
                'jobandfunc view',
                'employee view',
                'calendar view'
            ],
            'menus' => [
                [
                    'title' => 'Profile',
                    'icon' => '<i class="bi bi-buildings-fill"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'historical view',
                        'jobandfunc view',
                        'employee view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Historical Content',
                            'route' => '/historicals',
                            'permission' => 'historical view'
                        ],
                        [
                            'title' => 'Job & Function Content',
                            'route' => '/jobandfuncs',
                            'permission' => 'jobandfunc view'
                        ],
                        [
                            'title' => 'Employee',
                            'route' => '/employees',
                            'permission' => 'employee view'
                        ]
                    ]
                ],
                [
                    'title' => 'Training',
                    'icon' => '<i class="bi bi-buildings-fill"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'calendar view',
                        'profiletraining view',
                        'collaboration view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Calendar Training',
                            'route' => '/calendars',
                            'permission' => 'calendar view'
                        ],
                        [
                            'title' => 'Profile Training',
                            'route' => '/profiletrainings',
                            'permission' => 'profiletraining view'
                        ],
                        [
                            'title' => 'Coolaboration',
                            'route' => '/collaborations',
                            'permission' => 'collaboration view'
                        ],
                    ]
                ],
                [
                    'title' => 'Information',
                    'icon' => '<i class="bi bi-buildings-fill"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'scholarship view',
                        'course view',
                        'announcement view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Scholarship',
                            'route' => '/scholarships',
                            'permission' => 'scholarship view'
                        ],
                        [
                            'title' => 'Other Course',
                            'route' => '/courses',
                            'permission' => 'course view'
                        ],
                        [
                            'title' => 'Announcement',
                            'route' => '/announcements',
                            'permission' => 'announcement view'
                        ]
                    ]
                ],
                [
                    'title' => 'Download',
                    'icon' => '<i class="bi bi-buildings-fill"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'material view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Training Material',
                            'route' => '/materials',
                            'permission' => 'material view'
                        ],
                        // [
                        //     'title' => 'Other Course',
                        //     'route' => '/courses',
                        //     'permission' => 'course view'
                        // ],
                        // [
                        //     'title' => 'Announcement',
                        //     'route' => '/announcements',
                        //     'permission' => 'announcement view'
                        // ]
                    ]
                ]
            ]
        ],
        // [
        //     'header' => 'Web Setting',
        //     'permissions' => [
        //         'highlight view'
        //     ],
        //     'menus' => [
        //         [
        //             'title' => 'Content Setting',
        //             'icon' => '<i class="bi bi-sliders"></i>',
        //             'route' => null,
        //             'permission' => null,
        //             'permissions' => [
        //                 'highlight view'
        //             ],
        //             'submenus' => [
        //                 [
        //                     'title' => 'Highlight Content',
        //                     'route' => '/highlights',
        //                     'permission' => 'highlight view'
        //                 ]
        //             ]
        //         ]
        //     ]
        // ],
        [
            'header' => 'Main',
            'permissions' => [
                'test view'
            ],
            'menus' => [
                [
                    'title' => 'Main Data',
                    'icon' => '<i class="bi bi-collection-fill"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'test view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Tests',
                            'route' => '/tests',
                            'permission' => 'test view'
                        ]
                    ]
                ]
            ]
        ],
    ],
];
