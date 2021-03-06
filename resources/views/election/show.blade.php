@extends('layouts.main')


@section('activity')
<div class="card">
    <h4 class="card-header text-center">
        {{$election->election_title}}
    </h4>
    <div class="card-body">
        <div class="row">
            <div class="col">
                {!! $chart->container() !!}
                {!! $chart->script() !!}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <h5 class="card-title">Start Date and Time</h5>
                <p class="card-text">{{$election->start_date}}</p>
            </div>
            <div class="col-sm-6">
                <h5 class="card-title">End Date and Time</h5>
                <p class="card-text">{{$election->end_date}}</p>
            </div>
        </div>
        <br>
        <div class="my-4">
            <h5 class="card-title">Description</h5>
            <p class="card-text">{{$election->election_description}}</p>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Candidate Name</th>
                    <th scope="col">Vote Count</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($election->candidates as $candidate)
                <tr>
                    <td>{{$candidate->name}}</td>
                    <td>{{$vote_data->where('user_id', $candidate->id)->count()}}</td>
                    <td><button type="button" class="btn btn-primary" id="vote_confirmation"
                            data-id="{{$candidate->id}}" data-name="{{$candidate->name}}" data-toggle="modal"
                            data-target="#vote_candidate">Vote</button></td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="vote_candidate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Election</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to vote <span id="candidate_name"></span> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('vote.store')}}" method="POST">
                    <input type="hidden" name="candidate_id" id="candidate_id" value="">
                    <input type="hidden" name="election_id" value="{{$election->id}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Vote</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#vote_confirmation", function () {
    let candidate_id = $(this).data('id');
    let candidate_name = $(this).data('name');
    $(".modal-body #candidate_name").text( candidate_name );
    $(".modal-footer #candidate_id").val( candidate_id );
  });
</script>
@endsection