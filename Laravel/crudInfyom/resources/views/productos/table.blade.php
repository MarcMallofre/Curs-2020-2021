<div class="table-responsive">
    <table class="table" id="productos-table">
        <thead>
            <tr>
                <th>Nom</th>
        <th>Descripcio</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nom }}</td>
            <td>{{ $producto->descripcio }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['productos.destroy', $producto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('productos.show', [$producto->id]) }}" class='text-dark' style='padding:15px;'>
                            <p>Veure</p>
                        </a>
                        <a href="{{ route('productos.edit', [$producto->id]) }}" class='text-primary' style='padding:15px;'>
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
