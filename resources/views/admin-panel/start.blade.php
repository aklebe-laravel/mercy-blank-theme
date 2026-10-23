@php
    $linkList = [
        'Settings' => [
            [
                'title' => 'Settings',
                'route' => route('admin-panel', ['page' => 'settings']),
            ],
        ],
        'Users' => [
            [
                'title' => 'Users',
                'route' => route('manage-data', ['modelName' => 'User']),
            ],
            [
                'title' => 'User Groups',
                'route' => route('manage-data', ['modelName' => 'AclGroup']),
            ],
            [
                'title' => 'Group Resources',
                'route' => route('manage-data', ['modelName' => 'AclResource']),
            ],
        ],
        'Products' => [
            [
                'title' => 'Products',
                'route' => route('manage-data', ['modelName' => 'Product']),
            ],
        ],
    ];
@endphp
<div class="description">
    <div class="chapter">
        @foreach($linkList as $title => $categoryData)
            <h2>{{ $title }}</h2>
            <ul>
                @foreach($categoryData as $linkData)
                    <li>
                        <a href="{{ $linkData['route'] }}">{{ __($linkData['title']) }}</a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>

</div>
