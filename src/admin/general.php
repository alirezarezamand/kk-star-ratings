<?php

$position = get_option('kksr_position', 'top-left');
$excludedLocations = get_option('kksr_exclude_locations', []);
$strategies = get_option('kksr_strategies', []);
// TODO: Make sure this is an array. For previous versions, this was stored as csv.
$excludedCategories = get_option('kksr_exclude_categories', []);

$categories = get_terms([
    'taxonomy' => 'category',
    'hide_empty' => false,
    'parent' => 0,
]);

$categoriesOptions = [];
foreach ($categories as $category) {
    $categoriesOptions[] = [
        'label' => $category->name,
        'value' => $category->term_id,
        'selected' => in_array($category->term_id, (array) $excludedCategories),
    ];
}

return [
    [
        'field' => 'checkbox',
        'id' => 'kksr_enable',
        'title' => __('Status', 'kk-star-ratings'),
        'label' => __('Active', 'kk-star-ratings'),
        'name' => 'kksr_enable',
        'value' => true,
        'checked' => (bool) get_option('kksr_enable'),
        'help' => __('Globally activate/deactivate the star ratings.', 'kk-star-ratings'),
    ],

    // Strategies

    [
        'id' => 'kksr_strategies',
        'title' => __('Strategies', 'kk-star-ratings'),
        'name' => 'kksr_strategies',
        'help' => __('Select the voting strategies.', 'kk-star-ratings'),
        'filter' => function ($values) {
            return (array) $values;
        },
        'fields' => [
            [
                'field' => 'checkbox',
                'label' => __('Allow voting in archives', 'kk-star-ratings'),
                'name' => 'kksr_strategies[]',
                'value' => 'archives',
                'checked' => in_array('archives', $strategies),
            ],
            [
                'field' => 'checkbox',
                'label' => __('Allow guests to vote', 'kk-star-ratings'),
                'name' => 'kksr_strategies[]',
                'value' => 'guests',
                'checked' => in_array('guests', $strategies),
            ],
            [
                'field' => 'checkbox',
                'label' => __('Unique votes (based on IP Address)', 'kk-star-ratings'),
                'name' => 'kksr_strategies[]',
                'value' => 'unique',
                'checked' => in_array('unique', $strategies),
            ],
        ],
    ],

    // Position

    [
        'id' => 'kksr_position',
        'title' => __('Default Position', 'kk-star-ratings'),
        'name' => 'kksr_position',
        'help' => __('Choose a default position.', 'kk-star-ratings'),
        'fields' => [
            [
                'field' => 'radio',
                'label' => __('Top Left', 'kk-star-ratings'),
                'name' => 'kksr_position',
                'value' => 'top-left',
                'checked' => $position == 'top-left',
            ],
            [
                'field' => 'radio',
                'label' => __('Top Center', 'kk-star-ratings'),
                'name' => 'kksr_position',
                'value' => 'top-center',
                'checked' => $position == 'top-center',
            ],
            [
                'field' => 'radio',
                'label' => __('Top Right', 'kk-star-ratings'),
                'name' => 'kksr_position',
                'value' => 'top-right',
                'checked' => $position == 'top-right',
            ],
            [
                'field' => 'radio',
                'label' => __('Bottom Left', 'kk-star-ratings'),
                'name' => 'kksr_position',
                'value' => 'bottom-left',
                'checked' => $position == 'bottom-left',
            ],
            [
                'field' => 'radio',
                'label' => __('Bottom Center', 'kk-star-ratings'),
                'name' => 'kksr_position',
                'value' => 'bottom-center',
                'checked' => $position == 'bottom-center',
            ],
            [
                'field' => 'radio',
                'label' => __('Bottom Right', 'kk-star-ratings'),
                'name' => 'kksr_position',
                'value' => 'bottom-right',
                'checked' => $position == 'bottom-right',
            ],
        ],
    ],

    // Locations

    [
        'id' => 'kksr_exclude_locations',
        'title' => __('Disable Locations', 'kk-star-ratings'),
        'name' => 'kksr_exclude_locations',
        'help' => __('Select the locations where the star ratings should be excluded.', 'kk-star-ratings'),
        'filter' => function ($values) {
            return (array) $values;
        },
        'fields' => [
            [
                'field' => 'checkbox',
                'label' => __('Home page', 'kk-star-ratings'),
                'name' => 'kksr_exclude_locations[]',
                'value' => 'home',
                'checked' => in_array('home', $excludedLocations),
            ],
            [
                'field' => 'checkbox',
                'label' => __('Archives', 'kk-star-ratings'),
                'name' => 'kksr_exclude_locations[]',
                'value' => 'archives',
                'checked' => in_array('archives', $excludedLocations),
            ],
            [
                'field' => 'checkbox',
                'label' => __('Posts', 'kk-star-ratings'),
                'name' => 'kksr_exclude_locations[]',
                'value' => 'posts',
                'checked' => in_array('posts', $excludedLocations),
            ],
            [
                'field' => 'checkbox',
                'label' => __('Pages', 'kk-star-ratings'),
                'name' => 'kksr_exclude_locations[]',
                'value' => 'pages',
                'checked' => in_array('pages', $excludedLocations),
            ]
        ],
    ],

    // Categories

    [
        'field' => 'select',
        'id' => 'kksr_exclude_categories',
        'title' => __('Disable Categories', 'kk-star-ratings'),
        'name' => 'kksr_exclude_categories',
        'multiple' => true,
        'filter' => function ($values) {
            return (array) $values;
        },
        'options' => $categoriesOptions,
        'help' => __('Exclude star ratings from posts belonging to the selected categories.<br>Use <strong>cmd/ctrl + click</strong> to select/deselect multiple categories.', 'kk-star-ratings'),
    ],

];