<?php
return [
    'roles' => [
        0   =>  'Admin',
        1   =>  'Staff',
        2   =>  'Student'
    ],
    'examinee' => [
        'status' => [
            0   =>  'Review',
            1   =>  'Examinee',
            2   =>  'Waiting',
            3   =>  'Fail',
            4   =>  'Passed'
        ],
        'gender' => [
            0   =>  'Male',
            1   =>  'Female'
        ]
    ],
    'subject' => [
        'status' => [
            'inactive'  =>  ['no' => 0, 'name' => 'Inactive'],
            'active'    =>  ['no' => 1, 'name' => 'Active']
        ]
    ],
    'question' => [
        'type' => [
            'identification'    => ['no' => 1, 'name' => 'Identification'],
            'multiple'          => ['no' => 2, 'name' => 'Multiple Choice']
        ]
    ],
    'college' => [
        1   => 'College of Arts and Sciences',
        2   => 'College of Agriculture, Forestry, Environment and Natural Resources',
        3   => 'College of Criminal Justice',
        4   => 'College of Economics, Management, and Development Studies',
        5   => 'College of Education',
        6   => 'College of Engineering and Information Technology',
        7   => 'College of Nursing',
        8   => 'College of Sports, Physical Education and Recreation',
        9   => 'College of Veterinary Medicine and Biomedical Sciences'
    ],
    'course' => [
        1   => [
            1   =>  'BA English Language Studies',
            2   =>  'BA Journalism',
            3   =>  'BA Political Science',
            4   =>  'BS Applied Mathematics',
            5   =>  'BS Biology',
            6   =>  'BS Psychology',
            7   =>  'BS Social Work'
        ],
        2   => [
            1   =>  'Bachelor of Agricultural Entrepreneurship',
            2   =>  'BS Agriculture',
            3   =>  'BS Environmental Science',
            4   =>  'BS Food Technology',
        ],
        3   => [
            1   =>  'BS Criminology',
            2   =>  'BS Industrial Security Management'
        ],
        4   => [
            1   =>  'BS Accountancy',
            2   =>  'BS Business Management',
            3   =>  'BS Development Management',
            4   =>  'BS Economics',
            5   =>  'BS International Studies',
        ],
        5   => [
            1   =>  'Bachelor of Early Childhood Education',
            2   =>  'Bachelor of Elementary Education',
            3   =>  'Bachelor of Secondary Education',
            4   =>  'Bachelor of Special Needs Education',
            5   =>  'Bachelor of Technology and Livelihood Education',
            6   =>  'BS Hospitality Management',
            7   =>  'BS Tourism Management',
            8   =>  'Teacher Certificate Program',
            9   =>  'Science High School',
            10  =>  'Elementary Education',
            11  =>  'Pre-Elementary Education',
        ],
        6   => [
            1   =>  'BS Agricultural and Biosystems Engineering',
            2   =>  'BS Architecture',
            3   =>  'BS Civil Engineering',
            4   =>  'BS Computer Engineering',
            5   =>  'BS Computer Science',
            6   =>  'BS Electrical Engineering',
            7   =>  'BS Electronics Engineering',
            8   =>  'BS Industrial Engineering',
            9   =>  'BS Industrial Technology Major in Automotive Technology',
            10  =>  'BS Industrial Technology Major in Electrical Technology',
            11  =>  'BS Industrial Technology Major in Electronics Technology',
            12  => 'BS Information Technology',
            13  => 'BS Office Administration',
        ],
        7   => [
            'BS Medical Technology',
            'BS Midwifery',
            'BS Nursing',
            'Diploma in Midwifery',
        ],
        8   => [
            'Bachelor of Physical Education',
            'Bachelor of Exercise and Sports Sciences',
        ],
        9   => [
            'Doctor of Veterinary Medicine'
        ]
    ]
];

