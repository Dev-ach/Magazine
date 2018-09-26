@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('quickadmin.qa_dashboard')</div>

                <div class="panel-body">
                    

                    <form action="{{ url('video')}}" method="post">
					{{ csrf_field() }}
                            <div class="col-xs-12 form-group">
                            <input type="text" name="lien" class="form-control" id="inputLien" placeholder="Entrer le lien de la video">
                            </div>
                            <button type="submit" class="btn btn-submit red">Submit</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
