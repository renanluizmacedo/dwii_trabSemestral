@extends('templates.main')
@section('conteudo')

<div class="row">
    <div class="col">

        <!-- Utiliza o componente "datalist" criado -->
        <x-datalistDisciplinas :header="['NOME', 'CURSO', 'AÇÕES']" 
        :data="$data" 
        :hide="[ false, true, false]" />

    </div>

</div>
@endsection