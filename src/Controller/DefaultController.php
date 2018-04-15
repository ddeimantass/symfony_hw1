<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller {

    /**
     * @Route("/", name="student_list")
     */
    public function list() {

        return $this->render('student/index.html.twig', array("students" => $this->getStudentData()));
    }
    /**
     * @Route("/student/{id}", name="student")
     */
    public function student($id) {

        return $this->render('student/show.html.twig', array("student" => $this->getStudentData($id)));
    }

    private function getStudentData($id = null){

        $data =  json_decode(file_get_contents(__DIR__.'/../../public/data.json'), true);
        $students = array();
        foreach ($data as $team => $members){
            foreach ($members["members"] as $student){
                $students[] = array("team" => $team, "mentor" => $members["mentor"], "name" => $student);
            }
        }

        return isset($id) && array_key_exists($id, $students) ? $students[$id] : $students;
    }
}
