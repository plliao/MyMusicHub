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
			<div> 
			{{ Form::open(array('action'=> 'SearchResultController@show' , 'method'=>'post'))}}
    			{{ Form::text('keyword')}}
   			{{ Form::submit('Search')}}
			{{ Form::close()}}
                    	Hello, {{ Auth::user()->name }}. You can search songs or artists here.
		     	</div>
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
		   <nav>
			<iframe src="https://open.spotify.com/embed?uri=spotify:track:4sPmO7WMQUAf45kwMOtONw" frameborder="0" allowtransparency="true"> </iframe>
                   </nav>
		</div>
            </div>
        </div>
    </div>
</div>
@endsection

