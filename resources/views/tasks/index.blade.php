@extends('app')

@section('content')

  <h1>ToDoリスト</h1>
  {{-- ラジオボタンを押した際に tasksコントローラのindexアクションを作動させる、その際にurlに localhost/tasks?range=0 の様にパラメータを付与する --}}
  {{-- issetで変数自体の存在確認をおこなっている。 --}}
  @if (isset( $range ))
  {{-- localhost/tasks?range=0 の様にurlにgetパラメータが存在する状態でアクセスした場合はこちらを表示する --}}
    <input type="radio" name="range" onclick="location.href='{{ route('tasks.index', ['range' => 0]) }}'" @if ($range === "0") checked @endif >全て
    <input type="radio" name="range" onclick="location.href='{{ route('tasks.index', ['range' => 1]) }}'" @if ($range === "1") checked @endif>作業中
    <input type="radio" name="range" onclick="location.href='{{ route('tasks.index', ['range' => 2]) }}'" @if ($range === "2") checked @endif>完了
  @else
  {{-- localhost/tasks の様にurlにgetパラメータが存在しない状態でアクセスした場合はこちらを表示する --}}
    <input type="radio" name="range" onclick="location.href='{{ route('tasks.index', ['range' => 0]) }}'" >全て
    <input type="radio" name="range" onclick="location.href='{{ route('tasks.index', ['range' => 1]) }}'" >作業中
    <input type="radio" name="range" onclick="location.href='{{ route('tasks.index', ['range' => 2]) }}'" >完了
  @endif
      
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
            <form action="{{ route('tasks.update', $task->id) }}" method="post" style="display: inline;">
              @csrf
              @if ($task->status === 0)
                <button type="submit">作業中</button>
              @endif
              @if ($task->status === 1)
                <button type="submit">完了</button>
              @endif
              {{ method_field('put') }}
            </form>
            
            <form action="{{ route('tasks.destroy', $task->id) }}" method="post" style="display:inline;">
              @csrf
              <button type="submit" name="id" value="{{ $task->id }}">削除</button>
              {{ method_field('delete') }}
            </form>
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
