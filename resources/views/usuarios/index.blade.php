@extends('layouts.app')

@section('title', __('usuarios.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Usuarios)
            <a href="{{ route('usuarios.create') }}" class="btn btn-success">{{ __('usuarios.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('usuarios.list') }} <small>{{ __('app.total') }} : {{ $usuarios->total() }} {{ __('usuarios.usuarios') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('usuarios.search') }}</label>
                        <input placeholder="{{ __('usuarios.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('usuarios.search') }}" class="btn btn-secondary">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('usuarios.title') }}</th>
                        <th>{{ __('usuarios.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $key => $usuarios)
                    <tr>
                        <td class="text-center">{{ $usuarios->firstItem() + $key }}</td>
                        <td>{!! $usuarios->title_link !!}</td>
                        <td>{{ $usuarios->description }}</td>
                        <td class="text-center">
                            @can('view', $usuarios)
                                <a href="{{ route('usuarios.show', $usuarios) }}" id="show-usuarios-{{ $usuarios->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $usuarios->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
