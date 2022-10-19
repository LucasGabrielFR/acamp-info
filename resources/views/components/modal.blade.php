<a class="btn btn-xs btn-default text-danger mx-1 shadow" data-toggle="modal"
    data-target="#deleteModal{{ $id }}"><i class="fa fa-lg fa-fw fa-trash"></i></a>
{{-- <div class="modal" tabindex="-1" role="dialog" id="deleteModal{{$id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deseja realmente excluir esse registro?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{$name}}</p>
            </div>
            <div class="modal-footer">
                <form action="{{$url}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}
<x-adminlte-modal id="deleteModal{{ $id }}" title="Deletar Registro" size="sm" theme="danger"
    icon="fas fa-trash" v-centered static-backdrop scrollable>
    <div>
        <p>{{ $name }}</p>
    </div>
    <x-slot name="footerSlot">
        <form action="{{ $url }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Deletar</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </x-slot>
</x-adminlte-modal>
