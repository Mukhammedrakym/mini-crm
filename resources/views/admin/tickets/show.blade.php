@extends('admin.layout')

@section('title', 'Ticket #' . $ticket->id)

@section('content')
    <a href="{{ route('admin.tickets.index') }}">← Назад</a>

    <h1>Заявка #{{ $ticket->id }}</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert error">
            {{ $errors->first() }}
        </div>
    @endif

    <h3>Клиент</h3>
    <p>
        <strong>{{ $ticket->customer->name }}</strong><br>
        {{ $ticket->customer->phone }}<br>
        {{ $ticket->customer->email }}
    </p>

    <h3>Заявка</h3>
    <p><strong>Тема:</strong> {{ $ticket->subject }}</p>
    <p><strong>Сообщение:</strong><br>{{ $ticket->message }}</p>

    <h3>Файлы</h3>
    @if($ticket->getMedia('attachments')->isEmpty())
        <p class="muted">Файлов нет</p>
    @else
        <ul>
            @foreach($ticket->getMedia('attachments') as $file)
                <li>
                    <a href="{{ $file->getUrl() }}" target="_blank">
                        {{ $file->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    <h3>Статус</h3>
    <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}" class="row">
        @csrf
        @method('PATCH')

        <select name="status">
            @foreach($statuses as $status)
                <option value="{{ $status->value }}" @selected($ticket->status === $status)>
                    {{ $status->value }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>

    @if($ticket->answered_at)
        <p class="muted">Ответ дан: {{ $ticket->answered_at->format('d.m.Y H:i') }}</p>
    @endif
@endsection
