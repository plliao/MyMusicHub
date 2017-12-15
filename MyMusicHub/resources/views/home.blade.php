@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div id="sidebar" class="col-md-2">
                <h3><center>
                    Artists
                </h3></center>
                <nav id="sidebar-nav">
                    <ul class="nav nav-pills nav-stacked">
                        <?php foreach( $artists as $row){?>
                            <li>
                                {{ Html::linkAction(
                                    'ArtistController@show', 
                                    $row->ArtistTitle, 
                                    array(
                                        'ArtistId' => $row->ArtistId, 
                                        'ArtistTitle' => $row->ArtistTitle
                                    ) 
                                   ) 
                                }}
                            </li>
		                <?php }?>
                    </ul>
                </nav>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">My Music Hub</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

			<div> 
			{{ Form::open(array('action'=> 'SearchResultController@show' , 'method'=>'post'))}}
    			{{ Form::text('keyword')}}
   			{{ Form::submit('Search')}}
			{{ Form::close()}}
                    	Hello, {{ Auth::user()->name }}. You can search songs or artists here.
		     	</div>
		   <h3>User Information:</h3>
		   <?php foreach( $info as $row){?> 
		    <ul>
        		<li>User Account: <?php echo $row->username; ?></li>
        		<li>Name: <?php echo $row->name; ?></li>
        		<li>Email: <?php echo $row->email; ?></li>
			    <li>City: <?php echo $row->city; ?></li>
    	    </ul>
		   <?php }?>

            <div>
                <?php foreach( $playList as $row){?>
		            <h3>PlayList:</h3>
                    <ul>
                        <li><?php echo $row->title;?></li>
                    </ul>
                <?php }?>
            </div>

		</div>
            </div>
        </div>
    </div>
</div>
@endsection

