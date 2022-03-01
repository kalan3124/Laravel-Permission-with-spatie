<?php
return [
    "roles" => [
        [
            "label" => "Admin",
            "id" => 1,
        ],
        [
            "label" => "Writer",
            "id" => 2,
        ]
    ],
    "permission_data" => [
        "actions" => [
            [
                "label" => "Post Permission",
                "name" => "post_permissions",
            ],
            [
                "label" => "Other Permission",
                "name" => "other_permissions",
            ]
        ],
        "permissions" => [
            "post_permissions" => [
                [
                    "permission_id" => 1,
                    "name" => "edit posts",
                    "label" => "Edit",
                    "status" => 1
                ],
                [
                    "permission_id" => 2,
                    "name" => "delete posts",
                    "label" => "Delete",
                    "status" => 1
                ]
            ],
            "other_permissions" => [
                [
                    "permission_id" => 1,
                    "name" => "edit posts",
                    "label" => "Edit",
                    "status" => 1
                ],
                [
                    "permission_id" => 2,
                    "name" => "delete posts",
                    "label" => "Delete",
                    "status" => 1
                ]
            ],
        ]
    ]
];
