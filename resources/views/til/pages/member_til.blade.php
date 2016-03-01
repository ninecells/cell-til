<?php
use App\User;
$member = User::find($member_id);
?>

@extends('ncells::jumbotron.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div>
            @include('ncells::auth.parts.member_tab', ['member_id' => $member->id, 'tabitem_key' => 'til'])
            <div class="tab-content">
                <br/>
                <div role="tabpanel" class="tab-pane active">
                    여기에 보여줘야지
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
