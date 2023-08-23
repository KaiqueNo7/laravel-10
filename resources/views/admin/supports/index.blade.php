<h1>Listagem das dúvidas</h1>

<a href="{{ route('supports/create') }}">Criar duvida</a>

<table>
    <th>Assunto</th>
    <th>Status</th>
    <th>Descrição</th>
    <th></th>
    <tbody>
        @foreach ($supports->items() as $support)
        <tr>
            <td>{{ $support->subject }}</td>
            <td>{{ getStatusSupport($support->status) }}</td>
            <td>{{ $support->body }}</td>
            <td>
                <a href="{{route('supports/show', $support->id )}}">Ir</a>
                <a href="{{route('supports/edit', $support->id )}}">Ed</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<x-pagination :paginator="$supports" appends="$filters"/>