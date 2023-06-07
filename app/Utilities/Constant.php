<?php

namespace App\Utilities;

class Constant
{
    const CATEGORY = [
        'Berita' => [
            'id' => 1,
            'label' => 'Berita',
        ],
        'Artikel' => [
            'id' => 2,
            'label' => 'Artikel',
        ]
    ];

    const TYPE_OF_EMPLOYEE = [
        'Struktural' => [
            'id' => 1,
            'label' => 'Struktural',
        ],
        'Widyaiswara' => [
            'id' => 2,
            'label' => 'Widyaiswara',
        ],
        'Fungsional' => [
            'id' => 3,
            'label' => 'Fungsional',
        ],
        'Pelaksana' => [
            'id' => 4,
            'label' => 'Pelaksana',
        ],
        'PPNPN' => [
            'id' => 5,
            'label' => 'PPNPN',
        ],
    ];

    const TYPE_OF_PUBLIC_INFORMATION = [
        'Informasi Yang Wajib Disediakan Dan Diumumkan Secara Berkala' => [
            'id' => 1,
            'label' => 'Informasi Yang Wajib Disediakan Dan Diumumkan Secara Berkala',
        ],
        'Informasi Yang Wajib Diumumkan Secara Serta Merta' => [
            'id' => 2,
            'label' => 'Informasi Yang Wajib Diumumkan Secara Serta Merta',
        ],
        'Informasi Yang Wajiib Tersedia Setiap Saat' => [
            'id' => 3,
            'label' => 'Informasi Yang Wajiib Tersedia Setiap Saat',
        ],
    ];
}
