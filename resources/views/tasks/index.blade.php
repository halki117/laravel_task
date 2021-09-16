@extends('app')

@section('content')

  <h1>ToDoリスト</h1>

  <input type="radio" name="status" value="all">全て
  <input type="radio" name="status" value="all">作業中
  <input type="radio" name="status" value="all">完了

  <table class="tasks_container">
    @php
      $key = 0 
    @endphp
    @foreach ($tasks as $key => $task)
      <thead>
        <tr>
          <th>ID</th>
          <th>コメント</th>
          <th>状態</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $key }}</td>
          <td>{{ $task->comment }}</td>
          <td>
            @if ($task->status === 0)
              <button>作業中</button>
            @endif
            @if ($task->status === 1)
              <button>完了</button>
            @endif
            <button>削除</button>
          </td>
        </tr>
      </tbody>
      @php
        $key++ 
      @endphp
    @endforeach
  </table>

  <h2>新規タスクの追加</h2>
  <form action="{{ route('tasks.store') }}" method="post">
    @csrf
    <input type="text" name="comment" >
    <input type="submit" value="追加" >
  </form>

  @if($errors->has('comment')) <span class="text-danger">{{ $errors->first('comment') }}</span> @endif
  
  
@endsection

