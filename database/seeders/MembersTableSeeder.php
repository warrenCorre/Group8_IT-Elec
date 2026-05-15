<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MembersTableSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Michael Salvado',
                'role' => 'TEAM LEADER',
                'image' => 'michael.jpg',
                'bio' => 'Michael is a full-stack web developer and front-end engineer. He has experience leading teams and managing projects.',
                'age' => 22,
                'year' => '3rd Year',
                'email' => 'michael.salvado@group8.com',
                'skills' => ['Web Developer', 'Team Leadership', 'Project Management'],
                'order' => 1
            ],
            [
                'name' => 'Jefril Intima',
                'role' => 'DEVELOPER',
                'image' => 'epoy.jpg',
                'bio' => 'Jefril specializes in backend development and systems architecture.',
                'age' => 21,
                'year' => '3rd Year',
                'email' => 'jefril.intima@group8.com',
                'skills' => ['Backend Developer', 'Database Design', 'API Development'],
                'order' => 2
            ],
            [
                'name' => 'Flor Albert Asa',
                'role' => 'DESIGNER',
                'image' => 'flor.jpg',
                'bio' => 'Flor specializes in UI/UX design and human-computer interaction.',
                'age' => 21,
                'year' => '3rd Year',
                'email' => 'flor.asa@group8.com',
                'skills' => ['UI/UX Designer', 'Graphic Design', 'Prototyping'],
                'order' => 3
            ],
            [
                'name' => 'Leandro Tuyor',
                'role' => 'DEVELOPER',
                'image' => 'leandro.jpg',
                'bio' => 'Leandro is passionate about front-end development and creating responsive web applications.',
                'age' => 22,
                'year' => '3rd Year',
                'email' => 'leandro.tuyor@group8.com',
                'skills' => ['Frontend Developer', 'React', 'Responsive Design'],
                'order' => 4
            ],
            [
                'name' => 'Juster Loreto',
                'role' => 'TESTER',
                'image' => 'juster.jpg',
                'bio' => 'Juster specializes in quality assurance and software testing.',
                'age' => 21,
                'year' => '3rd Year',
                'email' => 'juster.loreto@group8.com',
                'skills' => ['QA Tester', 'Automation Testing', 'Bug Tracking'],
                'order' => 5
            ],
            [
                'name' => 'Axel Jay Laride',
                'role' => 'DOCUMENTATION',
                'image' => 'axel.jpg',
                'bio' => 'Axel handles technical documentation and project management.',
                'age' => 21,
                'year' => '3rd Year',
                'email' => 'axel.laride@group8.com',
                'skills' => ['Technical Writer', 'Documentation', 'Project Coordination'],
                'order' => 6
            ]
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}