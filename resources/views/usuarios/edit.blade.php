@extends('layouts.app')

@section('title', __('usuarios.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $usuarios)
        @can('delete', $usuarios)
            <div class="card">
                <div class="card-header">{{ __('usuarios.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('usuarios.title') }}</label>
                    <p>{{ $usuarios->title }}</p>
                    <label class="form-label text-primary">{{ __('usuarios.description') }}</label>
                    <p>{{ $usuarios->description }}</p>
                    {!! $errors->first('usuarios_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('usuarios.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('usuarios.destroy', $usuarios) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="usuarios_id" type="hidden" value="{{ $usuarios->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('usuarios.edit', $usuarios) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('usuarios.edit') }}</div>
            <form method="POST" action="{{ route('usuarios.update', $usuarios) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="title" class="form-label">{{ __('usuarios.title') }} <span class="form-required">*</span></label>
                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $usuarios->title) }}" required>
                        {!! $errors->first('title', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('usuarios.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $usuarios->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('usuarios.update') }}" class="btn btn-success">
                    <a href="{{ route('usuarios.show', $usuarios) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $usuarios)
                        <a href="{{ route('usuarios.edit', [$usuarios, 'action' => 'delete']) }}" id="del-usuarios-{{ $usuarios->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
