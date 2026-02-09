@extends('admin.layout')

@section('title', 'Tickets')

@section('content')
    <h1>Заявки</h1>

    <form method="GET" class="row" style="margin-bottom:12px;">
        <label class="muted">Статус:</label>
        <select name="status" onchange="this.form.submit()">
            <option value="">Все</option>
            @foreach($statuses as $status)
                <option value="{{ $status->value }}" @selected($currentStatus === $status->value)>
                    {{ $status->value }}
                </option>
            @endforeach
        </select>
        @if($currentStatus)
            <a href="{{ route('admin.tickets.index') }}" class="muted">сбросить</a>
        @endif
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
