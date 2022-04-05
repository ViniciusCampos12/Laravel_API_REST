<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;
use App\Repositories\CarroRepository;

class CarroController extends Controller
{

    private $carroRepository;

    public function __construct(Carro $carro)
    {

        //injeta o model em cada um dos métodos
        $this->carro = $carro;

        //injeta o repository nos métodos
        $this->carroRepository = new CarroRepository($this->carro);
    }

     /**
     * Exibe todos os dados
     *
     * @return retorna um JSON
     */
    public function index()
    {
        $dados = $this->carro->all();

        return response()->json($dados,200);
    }

    /**
     * Executa a inserção de dados no banco
     *
     * @param  \Illuminate\Http\Request  $request
     * @return retorna um JSON
     */
    public function store(Request $request)
    {

        $request->validate($this->carro->rules(),$this->carro->feedback());

        $carro = $this->carro->create([
         'nome'                       => $request->nome,
         'marca'                      => $request->marca,
         'cor'                        => $request->cor,
         'lugares'                    => $request->lugares,
         'freio_abs'                  => $request->freio_abs,
         'velocidade_maxima'          => $request->velocidade_maxima
        ]);

        return response()->json($carro,200);
    }

    /**
     * Exibe um registro especifico
     *
     * @param  id da model carro $id
     * @return retorna um JSON
     */
    public function show($id)
    {
        $carro = $this->carroRepository->PegarId($id);

        if($carro === null){
            return response()->json(['fail' => 'O carro solicitado não existe'],404);
        }

        return response()->json($carro,200);
    }


    /**
     * Atualiza um registro no banco de dados
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  id da model carro $id
     * @return retorna um JSON
     */
    public function update(Request $request,$id)
    {
        $request->validate($this->carro->rules(),$this->carro->feedback());

        $carro = $this->carroRepository->PegarId($id);

        if($carro === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        $carro->fill($request->all());
        $carro->save();

        return response()->json($carro, 200);
    }

    /**
     * Deleta um registro no banco de dados
     *
     * @param  id da model carro $id
     * @return  retorna um JSON
     */
    public function destroy($id)
    {
        $carro = $this->carroRepository->PegarId($id);

        if($carro === null){
            return response()->json(['fail'   => 'Não foi possivel excluir pois o carro não foi encontrado'],404);
        }
        $carro->delete();

        return response()->json(['sucess'   => 'Excluido com suceso'],200);

    }
}
