@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">MyMusicHub</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

		   <html>
    		     <body>
                    	You are logged in!  Hello, {{ Auth::user()->name }}
    	             </body>
		   </html>
		   <h3>User Information:</h3>
		   <?php foreach( $info as $row){?> 
		   <ul>
        		<li>User Account: <?php echo $row->username; ?></li>
        		<li>Name: <?php echo $row->name; ?></li>
        		<li>Email: <?php echo $row->email; ?></li>
			<li>City: <?php echo $row->city; ?></li>
    		   </ul>
		   <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
