<div class="box-body">
    <p>
   		
        <label>Categorias</label>
 
        <select multiple="multiple" name="idcategoria" id="idcategoria">

        @foreach ($categorias as $categoria)
        <option  value= "{{ $categoria->idcategoria}}" >{{$categoria->nombrecategoria}}</option>

        @endforeach



        </select>
  





    </p>
</div>
