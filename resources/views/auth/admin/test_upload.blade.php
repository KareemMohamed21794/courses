<?xml version="1.0" encoding="utf-8"?>
<Wordlist xmlns="http://www.schoolhousetech.com">
@foreach($arrData as $data)
	<Item>
		@if($data->word)<Word>{{ $data->word }}</Word>@endif

		@if($data->level)<Level>{{ $data->level }}</Level>@endif

		@if($data->classification)<Classification>{{ $data->classification }}</Classification>@endif

		@if($data->clue1)<Clue1>{{ $data->clue1 }}</clue1>@endif
			
	</Item>
@endforeach
</Wordlist>