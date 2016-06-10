<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sintegra;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Support\Facades\Auth;
use App\User;
use DOMDocument as DOM;
use DOMXPath as DOMXPath;


class SintegraController extends Controller {
    use Authenticatable;

    /**
     * exige autenticão para acessar o controller
     * atraves do middleware auth
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //return  Sintegra::all();
        $data = Sintegra::all();

        //return  Sintegra::all();
        return view('sintegra.home', ['dados' => $data] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        return Sintegra::create($request->input());
    }



    public function getConsulta($cnpj){

        $client = new Client();

        $response = $client->request('POST', 'http://www.sintegra.es.gov.br/resultado.php',[
            'form_params' => [
                'num_cnpj' => $cnpj,
                'num_ie' => '',
                'botao' => 'Consultar'
            ],
        ]);

        $body = $response->getBody();
        $string = $body;
        $string = preg_replace('/[\n\r\t:]/', '', $string);

        $doc = new DOM();
        $doc->loadHTML($string);

        $xpath = new DOMXPath($doc);
        $td = $xpath->query('//td');

        foreach($td as $conteudo) {
            $arrTitulo = array();
            $arrValor = array();
            foreach ($xpath->query('//td[@class="titulo"]', $conteudo) as $titulo) {
                $arrTitulo[] = trim($titulo->nodeValue);
            }
            foreach ($xpath->query('//td[@class="valor"]', $conteudo) as $valor) {
                $arrValor[] = trim($valor->nodeValue);
            }
            break;
        }

        $arrMerge = array();

        foreach($arrTitulo as $key => $valor){
            $arrMerge[$valor] = $arrValor[$key];
        }
        $return = str_replace(':','' , $arrMerge);
        $return = json_encode($return);
        $return = str_replace('\u00a0','' , $return);

        if (Auth::check())
        {
            $usuario = Auth::user();
            $sintegra = Sintegra::create([
                'cnpj' => $cnpj,
                'id_usuario' => $usuario->id,
                'resultado_json' => $return
            ]);
        }
        return $return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Sintegra::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $sintegra = Sintegra::findOrFail($id);
        $sintegra->fill($request->all())->save();
        return $sintegra;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $sintegra = Sintegra::findOrFail($id);
        $sintegra->delete();
        return view('sintegra.home', ['dados' => Sintegra::all()] );
    }

}
