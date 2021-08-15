@extends('layouts.user')
@section('styles')
@livewireStyles
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endsection
@section('content')
  <div class="container-fluid">
  	@include('layouts.parts.message')
    <div class="row justify-content-center">
      <div class="col-sm-12">
      	<div class="card">
            <div class="card-header">
                  {{__('Attending Examination')}} - {{$exam->name}}
      			<div class="card-header-actions">
                      <div >
                        <i class="fas fa-stopwatch"></i> <span id="timerTracker"></span><br>
                      </div>
                </div>
      		</div>
      	</div>
      </div>
  </div>
  @livewire('exam.attend',[$exam,$result])
</div>
@endsection
@section('scripts')
@livewireScripts
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>

        // Set the date we're counting down to
        var countDownDate = new Date("{{$result->finish_time}}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("timerTracker").innerHTML = hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timerTracker").innerHTML = "ENDED.";
            document.getElementById("examFormFinish").submit();
            // document..submit();
        }
        }, 1000);

        // This will chage elapsed time
        // Will be implimentd later version
        // var seconds = 0;
        // var countdown = setInterval(function() {
        //     seconds++;
        //     // document.getElementById("answerTime").value = seconds;
        //     document.getElementById("answerTime").value = seconds+ "s ";
        //     if (seconds <= 0) clearInterval(countdown);
        // }, 1000);


    </script>


    <script>
        window.addEventListener('alert', event => {
                    toastr[event.detail.type](event.detail.message,
                    event.detail.title ?? ''), toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                        }
                    });
        // window.livewire.on('questionStored', () => {
        //     $('#reportModal').modal('hide');
        // });
    </script>
@endsection
