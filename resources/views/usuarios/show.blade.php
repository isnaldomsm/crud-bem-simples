@extends('layouts.app')

@section('title', __('usuarios.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('usuarios.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('usuarios.title') }}</td><td>{{ $usuarios->title }}</td></tr>
                        <tr><td>{{ __('usuarios.description') }}</td><td>{{ $usuarios->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $usuarios)
                    <a href="{{ route('usuarios.edit', $usuarios) }}" id="edit-usuarios-{{ $usuarios->id }}" class="btn btn-warning">{{ __('usuarios.edit') }}</a>
                @endcan
                <a href="{{ route('usuarios.index') }}" class="btn btn-link">{{ __('usuarios.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
