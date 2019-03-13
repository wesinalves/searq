@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rg') ? ' has-error' : '' }}">
                            <label for="rg" class="col-md-4 control-label">RG</label>

                            <div class="col-md-6">
                                <input id="rg" type="text" class="form-control" name="rg" value="{{ old('rg') }}" required>

                                @if ($errors->has('rg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rg') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Endereço</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Telefone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('researcher') ? ' has-error' : '' }}">
                            <label for="researcher" class="col-md-4 control-label">Tipo pesquisador</label>

                            <div class="col-md-6">
                                <div class="custom-control custom-radio">
                                  <input type="radio" id="researcher1" name="researcher" class="custom-control-input" value="academic">
                                  <label class="custom-control-label" for="researcher1">Acadêmico</label>
                                </div>
                                <div class="custom-control custom-radio ">
                                  <input type="radio" id="researcher2" name="researcher" class="custom-control-input" value="independent">
                                  <label class="custom-control-label" for="researcher2">Independente</label>
                                </div>

                                @if ($errors->has('researcher'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('researcher') }}</strong>
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
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                                <p>
                                    Ao registrar-se, você estará concordando com nossos
                                    <a  href="#terms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="terms">Termos de uso</a> 
                                </p>
                            </div>
                        </div>
                    </form>
                  

                        <div class="collapse" id="terms">
                          <div class="card card-body">
                            <p>TERMOS DE USO E ACESSO AO BANCO DE DADOS MEMORY DO INSTITUTO EVANDRO CHAGAS</p>
                         
                            <p>Este documento regula o uso e acesso ao banco de dados Memory do Instituto Evandro Chagas disponível no endereço http://memory.iec.gov.br. O mesmo tem como objetivo possibilitar a leitura, visualização e download de todos os documentos associados aos registros descritivos na consulta remota. O aceite deste termo implica o reconhecimento às diretrizes e regras propostas.</p>
                             
                            <p>Os dados inseridos pelo usuário que deseja acessar a base Memory no cadastro são para uso interno da instituição. Somente por exigência legal, os dados específicos do usuário, sem sua anuência, serão fornecidos a autoridades externas à instituição. Cabe ao usuário manter os seus dados atualizados, por meio da edição de seu cadastro. A senha fornecida pelo sistema é de uso pessoal e intransferível, devendo ser mantida em sigilo pelo usuário.</p>
                             
                            <p>O Arquivo do Instituto Evandro Chagas visando proporcionar o acesso de seu acervo documental (Lei nº 8.159 – Lei de Arquivos) disponibiliza os documentos digitalizados (de acordo com as “Recomendações para digitalização de documentos arquivísticos do CONARQ”) mediante ao Sistema Memory. Ao realizar algum download de alguma imagem de nosso banco de dados, você se compromete a não utilizá-la para fins ilícitos (Lei nº 9.610 – Lei de Direitos Autorais) e, onde for divulgá-la citar os créditos ao custodiador do acervo por meio da seguinte frase: “ACERVO DO ARQUIVO DO INSTITUTO EVANDRO CHAGAS”. A consulta aos registros ou a reprodução dos documentos associados não confere aos usuários propriedade intelectual sobre os mesmos.</p>
                             
                            <p>Documentos públicos que se apresentem com restrições de acesso podem ser objeto de pedido de acesso por parte do usuário fundamentado na Lei de Acesso à Informação (Lei nº 12527 – Lei de Acesso à informação), recorrendo, para isso, a um dos contatos relacionados neste sítio, em página própria, que pareça o mais apropriado.</p>
                             
                            <p>O uso de informações, registros e documentos obtidos na base para divulgação, distorção, falsificação, plágio, calúnia, injúria, difamação, desrespeito à honra e imagem de terceiros enseja o risco de o usuário ser responsabilizado criminalmente, conforme preceitos constitucionais e legislação específica, como a LAI e o Código Penal.</p>
                          </div>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>







@endsection




