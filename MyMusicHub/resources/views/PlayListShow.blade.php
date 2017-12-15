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

		   <h3>PlayList Title: <?php echo $Title?> </h3>
		   <?php foreach($Tracks_in_List as $row){?> 
		   <ul>

        		<li>Tile:{{ Html::linkAction('PlayerController@play', $row->TrackName, array('TrackId' => $row->TrackId) ) }}</li>
			<ul>
        			<li>Duration: <?php echo date('i:s', $row->TrackDuration/1000); ?></li>
				<li>By Artist: <?php echo $row->ArtistTitle?> 
    		   	</ul>
		    </ul>
		   <?php }?>
		</div>
            </div>
        </div>
    </div>
</div>
@endsection

