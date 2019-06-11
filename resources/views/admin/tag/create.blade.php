@extends('admin.layout')
@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-12">
                <h3>标签</h3>
                <small>新增标签表单</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">新增标签表单</h3>
                    </div>
                    <div class="card-body">

                        @include('admin.partials.error')

                        <form role="form" method="POST" action="/admin/tag">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group row">
                                <label for="tag" class="col-md-3 col-form-label">标签</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="tag" id="tag" value="{{ $tag }}"
                                           autofocus>


                                </div>
                            </div>

                            @include('admin.tag._form')

                            <div class="form-group row">
                                <div class="col-md-7 col-md-offset-3">
                                    <button class="btn btn-primary btn-md" type="submit">
                                        <i class="fa fa-plus-circle"></i>
                                        添加新标签
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

@stop