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
                    'icon' => '<i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill-gear" viewBox="0 0 16 16">
                    <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.493 4.493 0 0 0 12.5 8a4.493 4.493 0 0 0-3.59 1.787A.498.498 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.476 4.476 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1V1Zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
                    <path d="M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                  </svg></i>',
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
                    'icon' => '<i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-up" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                  </svg></i>',
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
                    'title' => 'Download',
                    'icon' => '<i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                  </svg></i>',
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
                    ]
                ],
                [
                    'title' => 'Public Service',
                    'icon' => '<i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z"/>
                  </svg></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'public-information view',
                        'work-accountability view',
                        'service-information'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Public Information',
                            'route' => '/public-informations',
                            'permission' => 'public-information view'
                        ],
                        [
                            'title' => 'Work Accountability',
                            'route' => '/work-accountabilities',
                            'permission' => 'work-accountability view'
                        ],
                        [
                            'title' => 'Service Information',
                            'route' => '/service-informations',
                            'permission' => 'service-information view'
                        ]

                    ]
                ]
            ]
        ],
        [
            'header' => 'Information Setting',
            'permissions' => [
                'content view',
                'highlight view',
                'button-banner view',
            ],
            'menus' => [
                [
                    'title' => 'Button Banner',
                    'icon' => '<i class="bi bi-file-post-fill"></i>',
                    'route' => '/button-banners',
                    'permission' => 'button-banner view',
                ],
                [
                    'title' => 'Information',
                    'icon' => '<i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                  </svg></i>',
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
                        ]
                    ]
                ],
            ]
        ],
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
        // [
        //     'header' => 'Main',
        //     'permissions' => [
        //         'test view'
        //     ],
        //     'menus' => [
        //         [
        //             'title' => 'Main Data',
        //             'icon' => '<i class="bi bi-collection-fill"></i>',
        //             'route' => null,
        //             'permission' => null,
        //             'permissions' => [
        //                 'test view'
        //             ],
        //             'submenus' => [
        //                 [
        //                     'title' => 'Tests',
        //                     'route' => '/tests',
        //                     'permission' => 'test view'
        //                 ]
        //             ]
        //         ]
        //     ]
        // ],
    ],
];
