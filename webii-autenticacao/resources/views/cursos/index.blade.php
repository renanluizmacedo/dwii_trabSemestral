@extends('templates.main')
@section('conteudo')

<div class="row">
    <div class="col">

        <!-- Utiliza o componente "datalist" criado -->
        <x-datalistCursos :header="['NOME', 'SIGLA', 'AÇÕES']" 
        :data="$dados" 
        :hide="[ false, true, false]" />

    </div>

</div>
@endsection