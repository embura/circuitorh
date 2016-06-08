@extends('app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-3 col-sm-3 col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a data-toggle="tab" href="#home">Pesquisa</a></li>
                    <li><a data-toggle="tab" href="#menu1">Consulta</a></li>
                    <li><a data-toggle="tab" href="#menu2">Conf</a></li>
                </ul>

            </div>

            <div class="col-xs-9 col-sm-9 col-md-9">
                <div class="tab-content">

                    <div id="home" class="tab-pane fade in active">
                        <h3>Pesquisa</h3>
                        <form class="form-inline" role="form" method="GET" action="{{ url('/sintegra/cnpj/') }}">



                            <div class="form-group">
                                <label for="cnpj">CNPJ:</label>
                                <input  type="text" class="form-control" id="cnpj" name="cnpj"  placeholder="00.000.000/0000-00"
                                       pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}" autofocus required>
                            </div>
                            <button type="submit" id="pesquisar" class="btn btn-default">Pesquisar</button>
                        </form>


                    </div>

                    <div id="menu1" class="tab-pane fade">
                        <h3>Consulta</h3>

                    </div>

                    <div id="menu2" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Some content in menu 2.</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

