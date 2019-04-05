@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <img src={{ asset('images/authentication_fsn5.png')}}></img>
                <p>O <span style="font-style: italic">Sistema Memory</span> é o repositório dos Arquivos Pessoais custodiado pelo Instituto Evandro Chagas. Os acervos recolhidos pelo IEC são referentes aos pesquisadores que atuaram na instituição e que contribuíram de maneira significativa para o avanço da ciência da saúde na Amazônia. </p>
                <p>As atividades desenvolvidas pelo IEC com Arquivos Pessoais (recolhimento, arranjo, ordenação, conservação, descrição, digitalização, metadados e migração) são produtos do projeto “Implementação do Arquivo de Memória do IEC.
                    Metodologia para tratamento do Acervo Permanente” elaborado e aprovado em dezembro de 2013. O repositório apresenta a descrição dos acervos em todos os níveis hierárquicos de fundo de acordo com a Norma Brasileira de Descrição – NOBRADE. </p>
                <p>Além das descrições, a base contém os documentos digitalizados correspondentes a cada descrição, sempre respeitando as condições de acesso. Estão disponíveis documentos textuais e imagéticos que evidenciam tanto as diferentes atividades desenvolvidas pelos titulares dos Arquivos como o cotidiano desses atestados pelos seus "Egodocumentos". </p>
                <p>O Sistema foi desenvolvido pela equipe de TI da instituição de forma que atendesse as necessidades do Setor de Arquivo-SEARQ do IEC.</p>
              </div>
            </div>
                
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar-me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Esqueceu sua senha?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
