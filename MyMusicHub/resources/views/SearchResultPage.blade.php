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

		   <h3>Searching Results:</h3>
		   <?php foreach( $result as $row){?> 
		   <ul>

        		<li>ArtistTitle:{{ Html::linkAction('ArtistController@show', $row->ArtistTitle, array('ArtistId' => $row->ArtistId, 'ArtistTitle' => $row->ArtistTitle) ) }}</li>
			<ul>
        			<li>ArtistDescription: <?php echo $row->ArtistDescription; ?></li>
    		   	</ul>
		    </ul>
		   <?php }?>
		</div>
            </div>
        </div>
    </div>
</div>
@endsection

