@extends('app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-3 col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a data-toggle="tab" href="#home">Pesquisa</a></li>
                    <li><a data-toggle="tab" href="#menu1">Consulta</a></li>
                </ul>

            </div>

            <div class="col-xs-9 col-sm-9 col-md-9">
                <div class="tab-content">

                    <div id="home" class="tab-pane fade in active">
                        <h3>Pesquisa</h3>
                        {!! Form::open(array('action' => 'SintegraController@getConsulta', 'method' => 'GET','class' => 'form-inline')) !!}
                        {!! Form::label('cnpj', 'CNPJ') !!}
                        {!! Form::text('cnpj') !!}
                        {!! Form::button('Pesquisar', array('class' => 'btn btn-sucess','id'=>'pesquisar')) !!}
                        {!! Form::close() !!}

                        <div id="resultado"></div>

                    </div>

                    <div id="menu1" class="tab-pane fade">
                        <h3>Consulta </h3>

                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Usuário</th>
                                <th>CNPJ</th>
                                <th>JSON</th>
                                <th>Deletar</th>
                            </tr>
                            @foreach ($dados as $dado)
                                <tr>
                                    <td>{{ $dado->id }}</td>
                                    <td>{{ $dado->id_usuario }}</td>
                                    <td>{{ $dado->cnpj }}</td>
                                    <td>{{ $dado->resultado_json }}</td>
                                    <td>
                                    {!! Form::open(array('url' => 'sintegra/' . $dado->id, 'class' => 'pull-right')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('Remover', array('class' => 'btn btn-warning')) !!}
                                    {!! Form::close() !!}
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#pesquisar").click(function(){
                $.get( "/sintegra/cnpj/",function( data ) {
                    $("#resultado").html(data);
                }, "json" );
            });
        });
    </script>
@endsection
