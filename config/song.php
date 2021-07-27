<?php

return [
    'files' => [
        'paths' => [
            'pdf' => 'uploads/files/',
            'midi' => '/uploads/files/'
        ],
    ],
    'ithibati' => [
        'prefix' => "TEC/KMM/",
        'format' => "TEC/KMM/%s/%s/%s", //TEC/KMM/ithibatiNumber/songId/year
    ],
    'reviews' => [
        'no_of_songs_to_review' => 3,
        'no_of_reviews_per_song' => 3,
        'min_no_of_critical_reviews' => 2,
    ],
    'statuses' => [
        'approved' => 1,
        'approved_and_verified' => 2,
        'redraw' => 3,
        'pending' => 4,
        'denied' => 5,
        'waiting_for_ithibati' => 6,
        'received_ithibati_for_recording' => 7,
        'received_ithibati_active_on_site' => 8,
        'denied_ithibati' => 9,
        'deleted' => 10,
    ]
];
