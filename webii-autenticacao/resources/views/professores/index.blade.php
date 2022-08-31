@extends('templates.main')
@section('conteudo')

<div class="row">
    <div class="col">

        <!-- Utiliza o componente "datalist" criado -->
        <x-datalistProfessores :header="['NOME', 'EIXO','STATUS', 'AÇÕES']" :data="$data" :hide="[ false, true, true,false]" />

    </div>

</div>
@endsection