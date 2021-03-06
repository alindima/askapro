@extends('templates.auth.master')

@section('title')
	{{ $question->title }} - AskAPro
@stop

@section('content')
	<div class="show-question">
		<div class="header">
			<div class="top">
				<div class="user-profile">
					<img src="{{ $question->user->getProfilePicture() }}" alt="{{ $question->user->getName() }}">
					<div class="user-name">
						<a href="{{ route('profile', $question->user->name) }}">
							{{ $question->user->getName() }}
						</a>
					</div>
				</div>

				@can('update', $question)
					<div class="settings">
						<input type="checkbox" name="" id="settings-checkbox" class="hidden">
						<label for="settings-checkbox" class="settings-button">
							<i class="fa fa-cog" aria-hidden="true"></i>
						</label>

						<div class="settings-drop">
							<div class="setting question-edit">
								<a href="{{ route('question.edit', $question->slug) }}">
									<i class="fa fa-pencil" aria-hidden="true"></i>
									Edit question
								</a>
							</div>
							<div class="setting question-delete">
								<form action="{{ route('question.show', $question->slug) }}" method="post">
									{{ csrf_field() }}

									<input type="hidden" name="_method" value="delete">

									<button type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Delete question</button>
								</form>
							</div>
						</div>
					</div>
				@endcan
			</div>

			<div class="question-title">
				<h1>{{ $question->title }}</h1>
			</div>
			<div class="question-timestamps">
				{{ $question->created_at->diffForHumans() }}
			</div>
			<div class="question-tags">
				<ul class="tags">
					@foreach($question->tags as $tag)
						<li>{{ $tag->name }}</li>
					@endforeach
				</ul>
			</div>
		</div>
		
		<div class="main">
			{!! parsedown($question->body) !!}
		</div>

		<div class="answers">
			
			@if($question->answers->count())
				<div class="posted-answers">
					@foreach($question->answers as $answer)
						<div class="answer" id="{{ $answer->id }}">
							<div class="title{{ $answer->is_best() ? ' best-answer' : '' }}">
								<img src="{{ $answer->user->getProfilePicture() }}" alt="{{ $answer->user->getName() }}">
								<a href="{{ route('profile', $answer->user->name) }}">{{ $answer->user->getName() }}</a>
								
								@if($answer->is_best())
									<span class="best-answer-span">
										Best answer
									</span>
								@endif
							</div>
							<div class="body">
								{!! parsedown($answer->body) !!}
							</div>
							<div class="footer">
								<div class="left">
									{{ $answer->created_at->diffForHumans() }}
								</div>
								@can('markAnswer', $question)
									<div class="right">
										<a href="{{ route('answer.edit', [$question->slug, $answer->id]) }}">Edit</a>
										@if($answer->is_best())
											<a href="{{ route('answer.unmarkAsBest', [$question->slug, $answer->id]) }}">Unmark as best answer</a>
										@else
											<a href="{{ route('answer.markAsBest', [$question->slug, $answer->id]) }}">Mark as best answer</a>
										@endif
									</div>
								@endcan
							</div>
						</div>
					@endforeach	
				</div>
			@endif

			<div class="new-answer" id="new-answer">
				<form action="{{ route('answer.store', $question->slug) }}" method="post">
					<div class="tabs preview-tabs">
						<ul class="tab-list">
							<li class="tab-li active">
								<a href="#body">Body</a>
							</li>
							<li class="tab-li">
								<a href="#preview">Preview</a>
							</li>

							<a href="http://commonmark.org/help/" target="_blank" class="markdown-banner">
								Markdown is supported
							</a>
						</ul>
						<div class="tab-content">
							<div class="tab-panel active" id="body">
								<div class="fieldset{{ $errors->has('body') ? ' error' : '' }}">
									<textarea name="body" id="body" placeholder="I might have an answer for that...">{{ old('body') }}</textarea>
									
									@if($errors->has('body'))
										<span class="error-block">
											{{ $errors->first('body') }}
										</span>
									@endif
								</div>
							</div>
							<div class="tab-panel" id="preview"></div>
						</div>
					</div>
					
					{{ csrf_field() }}

					<button type="submit" class="button">Post answer</button>
				</form>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script>
		var route = "{{ route('api.markdown') }}";
	</script>
@stop