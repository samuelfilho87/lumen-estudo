<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    private $course;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->courser = $course;
    }

    public function index()
    {
        return Course::paginate(10);
    }

    public function show($course)
    {
        return Course::find($course);
    }

    public function store(Request $request)
    {
        $course = new Course;

        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->body = $request->input('body');
        $course->price = $request->input('price');

        $course->save();

        return response()->json([
            'data' => [
                'message' => 'Curso foi criado com sucesso',
                'course' => $course
            ]
        ]);
    }

    public function update($course, Request $request)
    {
        $course = Course::find($course);

        $course->update($request->all());

        return response()->json([
            'data' => [
                'message' => 'Curso foi atualizado com sucesso',
                'course' => $course
            ],
        ]);
    }

    public function destroy($course)
    {
        $course = Course::find($course);

        $course->delete();

        return response()->json([
            'data' => [
                'message' => 'Curso removido com sucesso',
                'course' => $course
            ]
        ]);
    }
}
