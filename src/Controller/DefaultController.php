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

        $data =  json_decode(file_get_contents(__DIR__.'/../../public/data.json'), true);
        $students = array();
        foreach ($data as $team => $members){
            foreach ($members["members"] as $student){
                $students[] = array("team" => $team, "mentor" => $members["mentor"], "name" => $student);
            }
        }

        return $this->render('student/index.html.twig', array("students" => $students));
    }
    /**
     * @Route("/student", name="student")
     */
    public function student(Request $request ) {

        return $this->render('student/show.html.twig', array(
                "academy" => $request->get("utm_source"),
                "mentor" => $request->get("utm_campaign"),
                "name" => $request->get("utm_term"),
                "team" => $request->get("utm_content"),
                )
        );
    }
}
