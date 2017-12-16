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
                        {{ session()->forget('status') }}
                    @endif

                    <div>
    		            <h3><?php echo $artist->ArtistTitle; ?>:</h3>
    		            <h4>
                            Description:<br> 
                            <?php echo $artist->ArtistDescription; ?>
                        </h4>

                    <form class="form-horizontal" method="POST" action="{{ action('ArtistController@like') }}">
                        {{ csrf_field() }}
                        <input id="ArtistId" type="hidden" name="ArtistId" 
                            value=<?php echo $artist->ArtistId; ?> />
                        <?php
                            if (!$likes->isEmpty())
                            {
                        ?>
                            <input id="like" type="hidden" name="like" value=0 />
                            <button type="submit" class="btn">
                                Unlike
                            </button>
                        <?php
                            } else {
                        ?>
                            <input id="like" type="hidden" name="like" value=1 />
                            <button type="submit" class="btn">
                                Like
                            </button>
                        <?php
                            }
                        ?>
                    </form>
                    </div>
                    <div>
    		        <?php foreach( $result as $row){?> 
    		            <ul>
                		    <li>
                            TrackName: {{ 
                                Html::linkAction(
                                    'PlayerController@play', 
                                    $row->TrackName, 
                                    array('TrackId' => $row->TrackId, 'AlbumId' => $row->AlbumId) 
                                ) 
                            }}
                            </li>
    				        <li>From Album: <?php echo $row->AlbumName;?></li>
    				        <li>Album Release Date: <?php echo $row->AlbumReleaseDate;?></li>
    				        <li>Duration: <?php echo date('i:s', $row->TrackDuration/1000); ?></li>
    		            </ul>
    		        <?php }?>
                    </div>
		        </div>
            </div>
        </div>
    </div>
</div>
@endsection

