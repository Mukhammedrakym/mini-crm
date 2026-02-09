@extends('admin.layout')

@section('title', 'Ticket #' . $ticket->id)

@section('content')
    <a href="{{ route('admin.tickets.index') }}">← Назад</a>

    <h1 class="page-title">Заявка #{{ $ticket->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
            <button type="button" class="alert-close" data-close>&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="section">
        <div class="section-title">Клиент</div>
        <div class="kv">
            <div class="label">Имя</div><div><strong>{{ $ticket->customer->name }}</strong></div>
            <div class="label">Телефон</div><div>{{ $ticket->customer->phone }}</div>
            <div class="label">Email</div><div>{{ $ticket->customer->email }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Заявка</div>
        <div class="kv">
            <div class="label">Тема</div><div>{{ $ticket->subject }}</div>
            <div class="label">Сообщение</div><div class="message">{{ $ticket->message }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Файлы</div>
        @if($ticket->getMedia('attachments')->isEmpty())
            <p class="muted">Файлов нет</p>
        @else
            <ul class="file-list">
                @foreach($ticket->getMedia('attachments') as $file)
                    <li>
                        <a href="{{ $file->getUrl() }}" target="_blank">
                            {{ $file->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="section">
        <div class="section-title">Статус</div>
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
    </div>
@endsection