@extends('admin.layout')

@section('title', 'Tickets')

@section('content')
    <h1>Заявки</h1>

    <form method="GET" class="row" style="margin-bottom:12px; flex-wrap:wrap;">
    <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}">
    <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}">

    <input type="text" name="email" placeholder="Email"
           value="{{ $filters['email'] ?? '' }}">

    <input type="text" name="phone" placeholder="Телефон"
           value="{{ $filters['phone'] ?? '' }}">

    <select name="status">
        <option value="">Все</option>
        @foreach($statuses as $status)
            <option value="{{ $status->value }}"
                @selected(($filters['status'] ?? null) === $status->value)>
                {{ $status->value }}
            </option>
        @endforeach
    </select>

    <button class="btn btn-primary">Фильтр</button>

    <a href="{{ route('admin.tickets.index') }}" class="muted">Сброс</a>
</form>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Клиент</th>
            <th>Контакты</th>
            <th>Тема</th>
            <th>Статус</th>
            <th>Создано</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>#{{ $ticket->id }}</td>
                <td>{{ $ticket->customer->name }}</td>
                <td>
                    {{ $ticket->customer->phone }}<br>
                    <span class="muted">{{ $ticket->customer->email }}</span>
                </td>
                <td>{{ $ticket->subject }}</td>
                <td>
                    <span class="badge {{ $ticket->status->value }}">
                        {{ $ticket->status->value }}
                    </span>
                </td>
                <td>{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.tickets.show', $ticket) }}">Открыть</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div style="margin-top:12px;">
    @if ($tickets->onFirstPage())
        <span class="muted">« Previous</span>
    @else
        <a href="{{ $tickets->previousPageUrl() }}">« Previous</a>
    @endif

    <span class="muted" style="margin:0 8px;">
        Page {{ $tickets->currentPage() }} of {{ $tickets->lastPage() }}
    </span>

    @if ($tickets->hasMorePages())
        <a href="{{ $tickets->nextPageUrl() }}">Next »</a>
    @else
        <span class="muted">Next »</span>
    @endif
@endsection
