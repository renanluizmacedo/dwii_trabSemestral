@extends('templates.main')
@section('conteudo')

<div class="row">
    <div class="col">

        <!-- Utiliza o componente "datalist" criado -->
        <x-datalistEixos :header="['NOME', 'AÇÕES']" 
        :data="$dados" 
        :hide="[ false, false]" />

    </div>

</div>
@endsection