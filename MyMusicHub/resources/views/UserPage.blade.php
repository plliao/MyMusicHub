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
		   <h3><?php echo $userName ?>'s PlayLists:</h3>
		   <?php foreach( $playList as $row){?> 
		         <ul>
		   	   <li>
			      Title:{{ Html::linkAction('UserPageController@show', $row->title, array('PlayListId' => $row->PlayListId) ) }}
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

