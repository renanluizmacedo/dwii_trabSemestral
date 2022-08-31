<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Docencia;


class DocenciaController extends Controller
{

    public function index()
    {
        $cursos  = Curso::with(['eixo']);

        $disciplinas = Disciplina::with(['curso'])->orderBy('curso_id')->orderBy('id')->get();

        $profs = Professor::orderBy('id')->get();

        return view('docencias.index', compact(['profs', 'disciplinas', 'cursos']));
    }

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {

        $rules = [
            'PROFESSOR_ID_SELECTED' => 'required',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($rules, $msgs);

        $ids_prof = $request->PROFESSOR_ID_SELECTED;
        $disciplina = $request->DISCIPLINA;


        for ($i = 0; $i < count($request->DISCIPLINA); $i++) {
            $doc = new Docencia();
            $doc->professor_id = $ids_prof[$i];
            $doc->disciplina_id = $disciplina[$i];
            $doc->save();
        }

        return redirect()->route('disciplinas.index');
    }


    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
