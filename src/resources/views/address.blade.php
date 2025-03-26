@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('main')
    <div class="content">
        <h1 class="content-ttl">住所の変更</h1>
        <form action="{{ route('address.update', $item->id) }}" class="content-form">
            <div class="form-inner">
                <label class="form--label">郵便番号
                <input type="text" name="zip" class="form--input">
                </label>
            </div>
            <div class="form-inner">
                <label class="form--label">住所
                <input type="text" name="address" class="form--input">
                </label>
            </div>
            <div class="form-inner">
                <label class="form--label">建物名
                <input type="text" name="building" class="form--input">
                </label>
            </div>
            <input type="hidden" name="item" value="{{ $item->id }}">
            <button class="form-btn" type="submit">更新する</button>
        </form>
    </div>
@endsection