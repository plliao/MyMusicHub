@extends('layouts.app')
@section('content')
<?php use Html; ?>
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

        		<li>ArtistTitle:{{ HTML::linkAction('SearchResultControl@show', $row->ArtistTitle) }}</li>
        		<li>ArtistDescription: <?php echo $row->ArtistDescription; ?></li>
    		   </ul>
		   <?php }?>
		</div>
            </div>
        </div>
    </div>
</div>
@endsection

