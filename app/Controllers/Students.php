<?php
namespace App\Controllers;

use App\Models\RecordsModel;
use App\Models\StudentModel;

class Students extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new RecordsModel();
    }

    // List all students (admin only)
    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/home');
        }

        $studentModel = new StudentModel();
        $students = $studentModel->findAll();

        $data = [
            'title'   => 'Students List',
            'content' => view('students/index', ['students' => $students])
        ];
        return view('view_template_01', $data);
    }

    // View a single student and their enrolled courses
    public function view($id = null)
    {
        $studentModel = new StudentModel();

        // If logged in as student → force their own ID
        if (session()->get('role') === 'student') {
            $id = session()->get('user_id');
        }

        $student = $studentModel->find($id);

        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Student not found");
        }

        // Get courses joined with takes
        $db = \Config\Database::connect();
        $courses = $db->table('takes')
            ->select('takes.id as enrollment_id, courses.course_code, courses.course_name, courses.credits')
            ->join('courses', 'takes.course_id = courses.id')
            ->where('takes.student_id', $id)
            ->get()
            ->getResultArray();

        $data = [
            'title'   => 'Student Detail',
            'content' => view('students/view', [
                'student' => $student,
                'courses' => $courses
            ])
        ];

        return view('view_template_01', $data);
    }
}
