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
		   <h3><?php echo $userinfo->username; ?></h3>
		   <h4>City: <?php echo $userinfo->city; ?></h4>
           <form class="form-horizontal" method="POST" action="{{ action('UserPageController@follow') }}">
                {{ csrf_field() }}
                <input id="username" type="hidden" name="username" 
                    value=<?php echo $userinfo->username; ?> />
                <?php
                    if (!$follower)
                    {
                ?>
                    <input id="follow" type="hidden" name="follow" value=1 />
                    <button type="submit" class="btn">
                        Follow
                    </button>
                <?php
                    } else {
                ?>
                    <input id="follow" type="hidden" name="follow" value=0 />
                    <button type="submit" class="btn">
                        UnFollow
                    </button>
                <?php
                    }
                ?>
           </form>
		   <h4>PlayLists:</h4>
		   <?php foreach( $playList as $row){?> 
		         <ul>
		   	   <li>
			      Title:{{ Html::linkAction('PlayListController@show', $row->title, array('PlayListId' => $row->PlayListId,
			   'Title' => $row->title) ) }}
			   </li>
				<ul>
				    <li>
					CreateDate: <?php echo $row->createDate; ?>
				    </li>
				</ul>
			 </ul>
		   <?php }?>
		</div>
            </div>
        </div>
    </div>
</div>
@endsection

