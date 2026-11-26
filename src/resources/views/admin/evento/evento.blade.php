@extends('layout.dashboard')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid"><div class="row">
      <div class="col-sm-6"><h1 class="mb-0 fs-3">Calendário de eventos</h1></div>
      <div class="col-sm-6"><nav aria-label="breadcrumb"><ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Eventos</li>
      </ol></nav></div>
    </div></div>
  </div>
  <div class="app-content"><div class="container-fluid">
    @if(session('success'))<div class="alert alert-success alert-dismissible" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button></div>@endif
    @if($errors->any())<div class="alert alert-danger" role="alert"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    @if($categorias->isEmpty())<div class="alert alert-warning" role="alert">Cadastre uma categoria ativa antes de adicionar eventos. <a href="{{ route('admin.categoria.index') }}">Ir para categorias</a></div>@endif
    <div class="card event-calendar-card">
      <div class="card-header event-calendar-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Agenda</h3>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-eventos" {{ $categorias->isEmpty() ? 'disabled' : '' }}><i class="bi bi-plus-lg me-1"></i>Novo evento</button>
      </div>
      <div class="card-body"><div id="event-calendar"></div></div>
    </div>
  </div></div>
</main>

<div class="modal fade" id="modal-add-eventos" tabindex="-1" aria-labelledby="modal-add-eventos-label" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form method="POST" action="{{ route('admin.eventos.store') }}">
      @csrf
      <div class="modal-header"><h5 class="modal-title" id="modal-add-evento-label">Adicionar evento</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label for="eventos-nome" class="form-label">Nome do evento</label><input id="eventos-nome" name="nome_evento" class="form-control" maxlength="100" value="{{ old('nome_eventos') }}" required></div>
        <div class="mb-3"><label for="eventos-categoria" class="form-label">Categoria</label><select id="eventos-categoria" name="id_categoria" class="form-select" required><option value="">Selecione uma categoria</option>@foreach($categorias as $categoria)<option value="{{ $categoria->id_categoria }}" @selected(old('id_categoria') == $categoria->id_categoria)>{{ $categoria->nome_categoria }}</option>@endforeach</select></div>
        <div class="mb-3"><label for="eventos-descricao" class="form-label">Descrição</label><textarea id="eventos-descricao" name="descricao_eventos" class="form-control" rows="3" required>{{ old('descricao_eventos') }}</textarea></div>
        <div class="row"><div class="col-sm-6 mb-3"><label for="evento-data" class="form-label">Data</label><input id="eventos-data" name="data_eventos" type="date" class="form-control" value="{{ old('data_eventos') }}" required></div><div class="col-sm-6 mb-3"><label for="eventos-horario" class="form-label">Horário</label><input id="eventos-horario" name="horario_eventos" type="time" class="form-control" value="{{ old('horario_eventos', '09:00') }}" required></div></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-primary" {{ $categorias->isEmpty() ? 'disabled' : '' }}>Salvar evento</button></div>
    </form>
  </div></div>
</div>

<link rel="stylesheet" href="{{ asset('admin/css/eventos.css') }}">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.20/index.global.min.js" crossorigin="anonymous"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const calendarElement = document.getElementById('event-calendar');
  const modalElement = document.getElementById('modal-add-eventos');
  const modal = new bootstrap.Modal(modalElement);
  const events = @json($eventos);
  const calendar = new FullCalendar.Calendar(calendarElement, {
    locale: 'pt-br',
    initialView: 'dayGridMonth',
    initialDate: @json($dataInicial),
    headerToolbar: { start: 'prev,next today', center: 'title', end: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek' },
    buttonText: { today: 'Hoje', month: 'Mês', week: 'Semana', day: 'Dia', list: 'Lista' },
    height: 'auto',
    nowIndicator: true,
    dayMaxEvents: true,
    events,
    dateClick(info) {
      document.getElementById('eventos-data').value = info.dateStr.slice(0, 10);
      document.getElementById('eventos-horario').value = info.dateStr.includes('T') ? info.dateStr.slice(11, 16) : '09:00';
      modal.show();
    },
    eventClick(info) {
      const date = info.event.start.toLocaleString('pt-BR', { dateStyle: 'short', timeStyle: 'short' });
      const description = info.event.extendedProps.description || '';
      const category = info.event.extendedProps.category || 'Sem categoria';
      window.alert(`${info.event.title}\n${date}\n${category}\n\n${description}`);
    }
  });
  calendar.render();
  @if($errors->any())
    modal.show();
  @endif
});
</script>
@endsection
