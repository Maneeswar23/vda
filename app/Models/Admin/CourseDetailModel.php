<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class CourseDetailModel extends Model
{
    protected $table         = 'course_details';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'course_id','hero_tagline','hero_quote',
        'eligibility','selection_procedure','vacancies',
        'exam_scheme','exam_centres','ssb_marks','total_marks'
    ];
    protected $useTimestamps = false;

    public function getByCourseId(int $courseId)
    {
        return $this->where('course_id', $courseId)->first();
    }
}