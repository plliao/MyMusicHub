
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

		   <h3>Tracks For <?php echo $artistname;?>:</h3> 
		   <?php foreach( $result as $row){?> 
		   <ul>

        		<li>TrackName:{{ Html::linkAction('SearchResultController@show', $row->TrackName, array('TrackName' => $row->TrackName) ) }}</li>
        		<li>Duration: <?php echo date('i:s', $row->TrackDuration/1000); ?></li>
    		   </ul>
		   <?php }?>
		</div>
            </div>
        </div>
    </div>
</div>
@endsection
