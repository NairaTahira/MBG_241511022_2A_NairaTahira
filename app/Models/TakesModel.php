<?php
namespace App\Models;

use CodeIgniter\Model;

class TakesModel extends Model
{
    protected $table      = 'takes';
    protected $primaryKey = 'id';

    protected $allowedFields = ['student_id', 'course_id', 'enroll_date'];
    protected $useTimestamps = false;
}
