@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('categorias::categories.title.categories') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('categorias::categories.title.categories') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.categorias.category.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('categorias::categories.button.create category') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover" id="listaCategoria">
                            <thead>
                            <tr>
                               
                                <th>{{ trans('categorias::categories.title.categorias') }}</th>
                                <th>{{ trans('categorias::categories.title.nombrecategoria') }}</th>
                               
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.categorias.category.edit', [$category->idcategoria]) }}">
                                        {{ $category->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.categorias.category.edit', [$category->idcategoria]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.categorias.category.destroy', [$category->idcategoria]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('categorias::categories.title.categorias') }}</th>
                                <th>{{ trans('categorias::categories.title.nombrecategoria') }}</th>
                                
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('categorias::categories.title.create category') }}</dd>
    </dl>
@stop






@push('js-stack')
<?php $locale = locale(); ?>
<script src="{{ Module::asset('categoria:js/AppCategoria.js') }}"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        AppCategoria.urlLanguageDataTable = '{{ Module::asset("core:js/vendor/datatables/{$locale}.json") }}';
        AppCategoria.urlListDataTable = '{{ route("admin.categorias.category.paginate") }}';
        return AppCategoria.index();
    });
</script>
