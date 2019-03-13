<!-- Modal -->
<div class="modal fade" id="dimensionModal" tabindex="-1" role="dialog" aria-labelledby="dimensionModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Dimensão e Suporte:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('dimension.attach')}}">
        <label for="slc_name">Dimensão:</label>
            <select id="slc_name" name="name" class="custom-select">
              <option>Selecione...</option>
                <option value="textual">Textual</option>
                <option value="iconografico">Iconográfico</option>
                <option value="cartografico">Cartográfico</option>
                <option value="tridimensional">Tridimensional</option>
                            
            </select>

        <label for="slc_type">Tipo</label>
            <select id="slc_type" name="type" class="custom-select">
              <option>Selecione...</option>
                <option value="documents">Documentos</option>
                <option value="pages">Páginas</option>
                <option value="sheets">Folhas</option>
                <option value="items">Itens</option>
                            
            </select>

          <label for="inp_size">Tamanho</label>
          <input id="inp_size" name="size" class="form-control">

      </div>
      {{ csrf_field() }}
      <input type="hidden" name="collection_id" value="{{$collection->id}}">      


      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>


    </form>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLongTitle">Exclusão de registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Deseja realmente excluir esse registro?

      <div class="modal-footer">
        <a href="{{route('collection.delete',['collection_id'=>$collection->id])}}" class="btn btn-primary">Sim</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
      </div>


    
    </div>
  </div>
</div>


