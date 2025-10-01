<?php
namespace App\Controllers;

use App\Models\CourseModel;  
use App\Models\TakesModel;

class Courses extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CourseModel(); 
    }

    public function index()
    {
        $courseModel = new CourseModel();
        $takeModel   = new TakesModel();

        $courses = $courseModel->findAll();
        $enrolledIds = [];

        if (session()->get('role') === 'student') {
            $studentId = session()->get('user_id');
            $enrolled  = $takeModel->where('student_id', $studentId)->findAll();
            $enrolledIds = array_column($enrolled, 'course_id');
        }

        $data = [
            'title'       => 'Courses',   
            'content'     => view('courses/index', [
                'courses'     => $courses,
                'enrolledIds' => $enrolledIds
            ])
        ];

        return view('view_template_01', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'admin') return redirect()->to('/courses');

        $data = [
            'title'   => 'Add Bahan Baku',
            'content' => view('courses/create')
        ];
        return view('view_template_01', $data);
    }

    public function store()
    {
        $this->model->save([
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('course_name'),
            'jumlah'     => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => $this->request->getPost('status'),
            'created_at' => $this->request->getPost('created_at')
        ]);
        return redirect()->to('/courses');
    }

    public function edit($id)
    {
        $course = $this->model->find($id);
        $data = [
            'title'   => 'Edit Bahan Baku',
            'content' => view('courses/edit', ['bahan_baku' => $course])
        ];
        return view('view_template_01', $data);
    }

    public function update($id)
    {
        $this->model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah'     => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => $this->request->getPost('status'),
            'created_at' => $this->request->getPost('created_at')
        ]);
        return redirect()->to('/courses');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/courses');
    }
}
