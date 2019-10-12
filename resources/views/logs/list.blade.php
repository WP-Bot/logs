<table class="table table-responsive-md table-striped">
	<thead class="thead-light">
		<tr>
			<th>Nickname</th>
			<th>Message</th>
			<th class="text-right">Timestamp</th>
		</tr>
	</thead>

	<tbody>

	@foreach ( $logs as $log )

		<tr id="log-{{ $log->id }}">
			<td>
				<a href="/nick/{{ $log->nickname }}">
					{{ $log->nickname }}
				</a>
			</td>
			<td>
				@if ( 'join' === $log->event )
					[JOIN]
				@elseif ( 'part' === $log->event )
					[PART] {{ $log->message }}
				@elseif ( 'kick' === $log->event )
					[KICK] {{ $log->message }}
				@elseif ( 'quit' === $log->event )
					[QUIT] {{ $log->message }}
				@else
					{{ $log->message }}
				@endif
			</td>
			<td class="text-right text-nowrap">
				<a href="/view/{{ date( "Y-m-d", strtotime( $log->time ) ) }}#log-{{ $log->id }}">
					{{ date( "Y-m-d H:i:s", strtotime( $log->time ) ) }}
				</a>
			</td>
		</tr>

	@endforeach

	</tbody>
</table>
