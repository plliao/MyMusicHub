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
		   <?php foreach( $TrackInfo as $data){?> 
		   <h3><?php echo $data->TrackName;?>:</h3> 
			<iframe src= <?php echo "https://open.spotify.com/embed?uri=spotify:track:" . $data->TrackId; ?> frameborder="0" allowtransparency="true"> </iframe>
		   <?php }?>
		</div>
            </div>
        </div>
    </div>
</div>
@endsection

