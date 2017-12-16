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

		   <h3>Artists Searching Results:</h3>
		   <?php foreach( $result as $row){?> 
		   <ul>

        		<li>ArtistTitle:{{ Html::linkAction('ArtistController@show', $row->ArtistTitle, array('ArtistId' => $row->ArtistId, 'ArtistTitle' => $row->ArtistTitle) ) }}</li>
			<ul>
        			<li>ArtistDescription: <?php echo $row->ArtistDescription; ?></li>
    		   	</ul>
		    </ul>
		   <?php }?>

		   <h3>Tracks Searching Results:</h3>
		   <?php foreach( $tracks as $row){?> 
		   <ul>

        		<li>TrackTitle:{{ 
                    Html::linkAction(
                        'PlayerController@play', 
                        $row->TrackName, 
                        array('TrackId' => $row->TrackId, 'AlbumId' => $row->AlbumId) 
                    ) 
                    }}</li>
			<ul>
        			<li>Album: <?php echo $row->AlbumName; ?></li>
        			<li>Duration: <?php echo date('i:s',$row->TrackDuration/1000); ?></li>
    		   	</ul>
		    </ul>
		   <?php }?>

		
		   <h3>Users Searching Results:</h3>
		   <?php foreach( $users as $row){?> 
		   <ul>

        		<li>UserName:{{ Html::linkAction('UserPageController@show', $row->username, array('userId' => $row->id, 'userName' => $row->username) ) }}</li>
		    </ul>
		   <?php }?>
		</div>
            </div>
        </div>
    </div>
</div>
@endsection

