@extends('layouts.profile')
@section('title', 'プロフィールの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール編集</h2>
                <form action="{{  action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                @csrf    
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">名前</label>
                        <div class="col-md-10">
                            <input class="form-control" name="name" rows="20" value="{{ $profile_form->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">性別</label>
                        <div class="col-md-10">
                            <select class="form-control" id="gender" name="gender">
                                <option value="0" @if($profile_form->gender === 0) selected  @endif>選択しない</option>
                                <option value="1" @if($profile_form->gender === 1) selected  @endif>男性</option>
                                <option value="2" @if($profile_form->gender === 2) selected  @endif>女性</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">趣味</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="hobby" rows="20">{{ $profile_form->hobby }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">自己紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ $profile_form->introduction }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profile_form->id }}">
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>更新履歴</h2>
                        <ul class="list-group">
                        <!-- $profile_form->ProfileHistoriesの「ProfileHistories」とは
                        /mynews/app/Profile.phpのProfileHistoriesメソッドである．-->
                            @if ($profile_form->ProfileHistories != NULL)
                                @foreach ($profile_form->ProfileHistories as $h)
                                    <li class="list-group-item">{{ $h->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>    
                </div>
            </div>
        </div>
    </div>
@endsection