<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class Enrollment extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // Enroll student to course (AJAX)
    public function enroll($courseId)
    {
        if (session()->get('role') !== 'student') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Unauthorized']);
        }

        $studentId = session()->get('user_id');
        $exists = $this->db->table('takes')
            ->where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->countAllResults();

        if ($exists == 0) {
            $this->db->table('takes')->insert([
                'student_id'  => $studentId,
                'course_id'   => $courseId,
                'enroll_date' => date('Y-m-d')
            ]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Enrolled']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Already enrolled']);
    }

    // app/Controllers/Enrollment.php (only relevant parts)
    public function submit()
    {
        $takeModel = new \App\Models\TakesModel();
        $studentId = session()->get('user_id');  // always use user_id!! not id..
        $courseIds = $this->request->getPost('course_ids');

        $added = [];
        if ($courseIds) {
            foreach ($courseIds as $cid) {
                $exists = $takeModel->where('student_id', $studentId)
                                    ->where('course_id', $cid)
                                    ->first();
                if (!$exists) {
                    $takeModel->insert([
                        'student_id' => $studentId,
                        'course_id'  => $cid,
                        'enroll_date'=> date('Y-m-d'),
                    ]);
                    $added[] = (int)$cid;
                }
            }
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'ok',
                'added'  => $added
            ]);
        }

        return redirect()->to('/courses')->with('success', 'Enrollment updated!');
    }

    // View Student's Enrolled Courses
    public function myCourses()
    {
        $studentId = session()->get('user_id');

        $courses = $this->db->table('takes')
            ->select('takes.id as enrollment_id, courses.course_code, courses.course_name, courses.credits')
            ->join('courses', 'takes.course_id = courses.id')
            ->where('takes.student_id', $studentId)
            ->get()
            ->getResultArray();

        // Calculate total SKS
        $totalSKS = 0;
        foreach ($courses as $c) {
            $totalSKS += $c['credits'];
        }

        $data = [
            'title'     => 'My Courses',
            'content'   => view('enrollment/my_courses', [
                'courses'   => $courses,
                'totalSKS'  => $totalSKS   // send to view
            ])
        ];
        return view('view_template_01', $data);
    }

}
