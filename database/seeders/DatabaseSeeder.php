<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\AcademicYear::create(['name' => '2026/2027', 'is_active' => true]);
        
        $majors = ['RPL', 'TKJ', 'Multimedia', 'Akuntansi', 'Pemasaran'];
        foreach ($majors as $major) {
            \App\Models\Major::create(['name' => $major]);
        }

        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@belajaronline.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $teacher = User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'teacher@belajaronline.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'subject' => 'Pemrograman',
            'gender' => 'Laki-laki',
        ]);
        
        $teacher->majors()->attach(\App\Models\Major::where('name', 'RPL')->first());

        $class7A = \App\Models\SchoolClass::create(['name' => '7A']);
        $class7B = \App\Models\SchoolClass::create(['name' => '7B']);
        $classRPL = \App\Models\SchoolClass::create(['name' => 'X RPL 1']);

        // --- 2. Create Master Subjects ---
        $masterMath = \App\Models\MasterSubject::create(['name' => 'Matematika']);
        $masterIndo = \App\Models\MasterSubject::create(['name' => 'Bahasa Indonesia']);

        // --- 3. Create Subjects ---
        $subjectMath = \App\Models\Subject::create([
            'name' => $masterMath->name,
            'school_class_id' => $classRPL->id,
            'teacher_id' => $teacher->id
        ]);
        $subjectIndo = \App\Models\Subject::create([
            'name' => $masterIndo->name,
            'school_class_id' => $classRPL->id,
            'teacher_id' => $teacher->id
        ]);

        \App\Models\Schedule::create([
            'school_class_id' => $classRPL->id,
            'subject_id' => $subjectMath->id,
            'day_of_week' => 'Senin',
        ]);
        \App\Models\Schedule::create([
            'school_class_id' => $classRPL->id,
            'subject_id' => $subjectIndo->id,
            'day_of_week' => 'Senin',
        ]);
        \App\Models\Schedule::create([
            'school_class_id' => $classRPL->id,
            'subject_id' => $subjectMath->id,
            'day_of_week' => 'Selasa',
        ]);

        \App\Models\Student::create([
            'name' => 'Muhammad Alief Wardana',
            'student_code' => 'STUDENT123',
            'class_id' => $classRPL->id,
            'attendance_number' => '12'
        ]);
    }
}
