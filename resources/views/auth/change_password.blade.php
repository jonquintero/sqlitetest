@extends('layouts.admin')
@section('title', trans('global.change_password'))

@section('content')
            <div class="card panel-primary">
                  <div class="card-header">{{trans('global.change_password')}} {{ Auth::user()->name }}</div>
                    
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.users.changePassword')  }}">
                   
                         @csrf
           
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label"> {{ trans('global.confirm_password') }} </label>

                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        
                            <div class="form-group row mb-0">
                                <button type="submit" id='btnsummit' class="btn btn-primary btn-block my-2">{{ trans('global.save') }}</button>
                            </div>

                    </form>
                </div>
            </div>
@endsection
