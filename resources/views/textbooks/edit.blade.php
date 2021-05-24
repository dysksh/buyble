@extends('layouts.app')

@section('content')
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">教科書編集</div>
                    <div class="card-body">
                       @include('commons.flash')
                      
                            <form action="{{ route('textbooks.update', $textbook->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="isbn_no">
                                ISBN番号
                                </label>
                                <div>
                                <input type="text" name="isbn_no" value="{{ $textbook->isbn_no }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title">
                                タイトル
                                </label>
                                <div>
                                <input type="text" name="title" value="{{ $textbook->title }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="author">
                                著者名
                                </label>
                                <div>
                                <input type="text" name="author" value="{{ $textbook->author }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="classification_id">
                                分類
                                </label>
                                <div>  
                                    <select name="classification_id" id="">
                                        @foreach ($classifications as $classification)
                                            <option value="{{ $classification->id }}"<?= $textbook->classification_id===$classification->id ? 'selected': "" ?>>{{ $classification->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="condition_id">
                                状態
                                </label>
                                <div>
                                    <select name="condition_id" id="">
                                        @foreach ($conditions as $condition)
                                            <option value="{{ $condition->id }}"<?= $textbook->condition_id===$condition->id ? 'selected': "" ?>>{{ $condition->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price">
                                売値
                                </label>
                                <div>
                                <input type="text" name="price" value="{{ $textbook->price }}">
                                </div>
                            </div>    
                            <button type="submit" class="user-btn">更新</button>
                            </form>
                       </div>
                  </div>
             </div>
         </div>
     </div>
 </div>
@endsection