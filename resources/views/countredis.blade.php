<div>{{ $count }}</div>
<form action="{{ route('countup') }}" method="post">
    @csrf
    <input type="submit" value="カウント">
</form>