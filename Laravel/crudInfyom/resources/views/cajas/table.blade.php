<div class="table-responsive">
    <table class="table" id="cajas-table">
        <thead>
            <tr>
                <th>Nombre</th>
        <th>Capacidad</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cajas as $caja)
            <tr>
                <td>{{ $caja->nombre }}</td>
            <td>{{ $caja->capacidad }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cajas.destroy', $caja->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cajas.show', [$caja->id]) }}" class='text-dark' style='padding:15px;'>
                            <p>Veure</p>
                        </a>
                        <a href="{{ route('cajas.edit', [$caja->id]) }}" class='text-primary' style='padding:15px;'>
                            <p>Editar</p>
                        </a>
                        {!! Form::button('<p>Borrar</p>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
