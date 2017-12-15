@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Music Hub</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        {{ session()->forget('status') }}
                    @endif
		            <?php foreach( $TrackInfo as $data){?> 
		                <h3><?php echo $data->TrackName;?>:</h3> 
			            <iframe src= 
                            <?php echo "https://open.spotify.com/embed?uri=spotify:track:" 
                            . $data->TrackId; ?> 
                            frameborder="0" allowtransparency="true"> 
                        </iframe>
		            <?php }?>
                    <form class="form-horizontal" method="POST" action="{{ action('PlayerController@rate') }}">
                        {{ csrf_field() }}
                        Rate the track:
                        <?php foreach (range(1, 5) as $number) {?> 
                            <input id="rate" type="radio" name="rate" value=
                                <?php 
                                    echo $number;
                                    if (!$Rating->isEmpty() and $Rating->first()->rating==$number)
                                        echo " checked";
                                ?>><?php echo $number;?>
                            </input>
                        <?php }?>
                        <input id="TrackId" type="hidden" name="TrackId" 
                            value="{{ app('request')->input('TrackId') }}"/>
                        <button type="submit" class="btn">
                            Rate
                        </button>
                    </form>
                    @if (count($PlayList) > 0)
                        <form class="form-horizontal" method="POST" action="{{ action('PlayerController@store') }}">
                            {{ csrf_field() }}
                            Add to PlayList:
                            <select id="PlayListId"  name="PlayListId">
		                            <?php foreach( $PlayList as $list){?> 
                                    <option value=<?php echo $list->PlayListId;?>>
                                        <?php echo $list->title;?>
                                    </option>
		                            <?php }?>
                            </select>
                            <input id="TrackId" type="hidden" name="TrackId" 
                                value="{{ app('request')->input('TrackId') }}"/>
                            <button type="submit" class="btn">
                                Add
                            </button>
                         </form>
                    @endif
		        </div>
            </div>
        </div>
    </div>
</div>
@endsection

