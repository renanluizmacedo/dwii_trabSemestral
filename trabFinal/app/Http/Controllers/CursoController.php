<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Eixo;

class CursoController extends Controller
{
    public function index()
    {
        $dados = Curso::orderBy('nome')->get();

        return view('cursos.index', compact('dados'));
    }

    public function create()
    {
        $eixos = Eixo::orderBy('nome')->get();
        return view('cursos.create', compact(['eixos']));
    }

    public function store(Request $request)
    {
        Curso::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'sigla' => mb_strtoupper($request->sigla, 'UTF-8'),
            'tempo' => $request->tempo,
            'eixo_id' => $request->eixo,

        ]);

        return redirect()->route('cursos.index');
    }

    public function edit($id)
    {
        $eixos = Eixo::orderBy('nome')->get();
        $dados = Curso::find($id);

        if (isset($dados)) {
            return view('cursos.edit', compact(['dados', 'eixos']));
        } else {
            $msg = "Curso";
            $link = "cursos.index";
            return view('erros.id', compact(['msg', 'link']));
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nome' => 'required|max:50|min:10',
            'sigla' => 'required|max:8,|min:2',
            'tempo' => 'required|max:2|min:1',
            'eixo' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($rules, $msgs);

        $eixo = Eixo::find($request->eixo);
        $obj = Curso::find($id);
        if (isset($eixo) && isset($obj)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $obj->tempo = $request->tempo;
            $obj->eixo()->associate($eixo);
            $obj->save();
            return redirect()->route('cursos.index');
        }

        $msg = "Curso ou Eixo";
        $link = "cursos.index";
        return view('erros.id', compact(['msg', 'link']));
    }

    public function destroy($id)
    {
        $obj = Curso::find($id);

        if (isset($obj)) {
            $obj->delete();
        } else {
            $msg = "Curso";
            $link = "cursos.index";
            return view('erros.id', compact(['msg', 'link']));
        }

        return redirect()->route('cursos.index');
    }
}
