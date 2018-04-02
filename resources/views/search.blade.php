@extends('layouts.searchlayout')

@section('content')
<!-- Begin page content -->
    <main role="main" class="container ">
      <div class="mt-3">
        <h1>Pesquisa de Acervo</h1>
      </div>
      <form class="form-inline">
        <div class="form-group">
          <label for="inputPassword6">Tipo de documento</label>
          <input type="text" id="inputPassword6" class="form-control mx-sm-3" >
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Iniciado por...</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">Contendo</label>
          </div>
          
        </div>
        <button type="submit" class="btn btn-primary mb-2">Pesquisar</button>
      </form>

      <form>
      	<p>Busca Rápida A B C D E F G H I J L M N O P Q R S T U V X Z</p>
      </form>

      <form action="{{route('results')}}">
      	<div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Todos os selecionados</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">Qualquer um dos selecionados</label>
          </div>

          <div class="form-group">
              <label for="exampleFormControlSelect2">Termos disponíveis: 465</label>
              <select multiple class="form-control" id="exampleFormControlSelect2">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>5</option>
                <option>5</option>
                <option>5</option>
                <option>5</option>
                <option>5</option>
                <option>5</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Pesquisar</button>
      </form>

      
    </main>
@endsection