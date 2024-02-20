@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>AbandonedCart / Show #{{ $abandoned_cart->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('abandoned_carts.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('abandoned_carts.edit', $abandoned_cart->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>User_id</label>
<p>
	{{ $abandoned_cart->user_id }}
</p> <label>User_id</label>
<p>
	{{ $abandoned_cart->user_id }}
</p> <label>Plan_id</label>
<p>
	{{ $abandoned_cart->plan_id }}
</p> <label>Plan_id</label>
<p>
	{{ $abandoned_cart->plan_id }}
</p> <label>Ip</label>
<p>
	{{ $abandoned_cart->ip }}
</p> <label>Total</label>
<p>
	{{ $abandoned_cart->total }}
</p> <label>Status</label>
<p>
	{{ $abandoned_cart->status }}
</p> <label>Account_id</label>
<p>
	{{ $abandoned_cart->account_id }}
</p> <label>Account_id</label>
<p>
	{{ $abandoned_cart->account_id }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
