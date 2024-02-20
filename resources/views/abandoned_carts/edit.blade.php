@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h1>
                        <i class="glyphicon glyphicon-edit"></i> AbandonedCart /
                        @if($abandoned_cart->id)
                            Edit #{{$abandoned_cart->id}}
                        @else
                            Create
                        @endif
                    </h1>
                </div>

                @include('common.error')

                <div class="panel-body">
                    @if($abandoned_cart->id)
                        <form action="{{ route('abandoned_carts.update', $abandoned_cart->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                    @else
                        <form action="{{ route('abandoned_carts.store') }}" method="POST" accept-charset="UTF-8">
                            @endif

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            
                <div class="form-group">
                    <label for="user_id-field">User_id</label>
                    <input class="form-control" type="text" name="user_id" id="user_id-field" value="{{ old('user_id', $abandoned_cart->user_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="user_id-field">User_id</label>
                    <input class="form-control" type="text" name="user_id" id="user_id-field" value="{{ old('user_id', $abandoned_cart->user_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="plan_id-field">Plan_id</label>
                    <input class="form-control" type="text" name="plan_id" id="plan_id-field" value="{{ old('plan_id', $abandoned_cart->plan_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="plan_id-field">Plan_id</label>
                    <input class="form-control" type="text" name="plan_id" id="plan_id-field" value="{{ old('plan_id', $abandoned_cart->plan_id ) }}" />
                </div> 
                <div class="form-group">
                	<label for="ip-field">Ip</label>
                	<input class="form-control" type="text" name="ip" id="ip-field" value="{{ old('ip', $abandoned_cart->ip ) }}" />
                </div> 
                <div class="form-group">
                    <label for="total-field">Total</label>
                    <input class="form-control" type="text" name="total" id="total-field" value="{{ old('total', $abandoned_cart->total ) }}" />
                </div> 
                <div class="form-group">
                    <label for="status-field">Status</label>
                    <input class="form-control" type="text" name="status" id="status-field" value="{{ old('status', $abandoned_cart->status ) }}" />
                </div> 
                <div class="form-group">
                    <label for="account_id-field">Account_id</label>
                    <input class="form-control" type="text" name="account_id" id="account_id-field" value="{{ old('account_id', $abandoned_cart->account_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="account_id-field">Account_id</label>
                    <input class="form-control" type="text" name="account_id" id="account_id-field" value="{{ old('account_id', $abandoned_cart->account_id ) }}" />
                </div>

                            <div class="well well-sm">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a class="btn btn-link pull-right" href="{{ route('abandoned_carts.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

@endsection