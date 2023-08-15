<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        return view('admin/supports/index', compact('supports'));
    }

    public function show(string|int $id)
    {
       // Support::find($id) Aqui filtra somente pela primary key
       // Support::where('id', $id)->first(); Aqui pode filtrar por qualquer campo da base de dados
       // Support::where('id', '!=', $id)->first(); Só pega se o valor for diferente
       // Support::where('id', '=', $id)->first(); Só pega se o valor for igual
       if(!$support = Support::find($id)){
        return redirect()->back(); // Manda o usuário de volta para pagina que veio se o valor for igual a null
       };

        //dd($support->subject);
        //dd($support);

        return view('admin/supports/show', compact('support'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    //public function store(Request $request) DUAS FORMAS DE FAZER
    public function store(Request $request, Support $support)
    {
        //dd($request->body); PEGA O VALOR DO CAMPO DE FORMA SIMPLIFICADA
        //dd($request->get('axas', 'default')); se campo não existir define valor como default
        //dd($request->get('body'));

        $data = $request->all(); // PEGA TODOS OS DADOS DO FORMULÁRIO
        $data['status'] = 'a'; // DEFINE O VALOR STATUS COMO 'A'

        //Support::create($data); // Cadastro os valores na base de dados com os dados passados na variavel
       // $support->create($data);
        $support = $support->create($data);
        //dd($support); //valida 

        return redirect()->route('supports/index');
    }

    public function edit(Support $support, string|int $id)
    {
        if(!$support =$support->where('id', $id)->first()){
            return back();
        }

        return view('admin/supports/edit', compact('support'));
    }

    public function update(Request $request, Support $support, string $id)
    {
        if(!$support = $support->find($id)){
            return back(); 
        }

        // PEGANDO INDIVIDUALMENTE
        // $support->subject = $request->subject;
        // $support->body = $request->body;
        // $support->save();

        // PEGANDO ATRAVÉS DE UM ARRAY
        $support->update($request->only([
            'subject', 'body' // SÓ VOU TRAZER E EDITAR ESSES DOIS VALORES
        ]));

        return redirect()->route('supports/index');
    }

    public function destroy(string|int $id)
    {
        //if(!$support = Support::find($id)->delete()){
        if(!$support = Support::find($id)){
            return back();
        }

        $support->delete();

        return redirect()->route('supports/index');

    }
}
