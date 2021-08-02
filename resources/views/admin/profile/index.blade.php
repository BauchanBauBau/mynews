@extends('layouts.profile')
@section('title', '登録されているプロフィールの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>登録されているプロフィールの一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\ProfileController@create') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('ProfileController@index') }}" method="get">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2">名前</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="profile_title" value="{{ $profile_title }}">
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">名前</th>
                                <th width="20%">性別</th>
                                <th width="25%">趣味</th>
                                <th width="25%">自己紹介</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profiles as $profile)
                                <tr>
                                    <th>{{ $profile->id }}</th>
                                    <td>{{ $profile->name }}</td>
                                    <td>
                                        @if($profile->gender == 1)選択しない
                                        @elseif($profile->gender == 2)男性
                                        @else女性
                                        @endif
                                    </td>
                                    <td>{{ $profile->hobby }}</td>
                                    <td>{{ $profile->introduction }}</td>
                                    <td><a href="{{ action('Admin\ProfileController@edit', ['id' => $profile->id]) }}">編集</a></td>
                                    <td><a href="{{ action('Admin\ProfileController@delete', ['id' => $profile->id]) }}">削除</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection