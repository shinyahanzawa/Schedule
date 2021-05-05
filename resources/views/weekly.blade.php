@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <a class="btn btn-outline-secondary float-left" href="{{ url('weekly/?date=' . $calendar->getPreviousWeek()) }}">先週</a>

                    <span>{{ $calendar->getTitle() }}</span>

                    <a class="btn btn-outline-secondary float-right" href="{{ url('weekly/?date=' . $calendar->getNextWeek()) }}">翌週</a>
                </div>
                <div class="card-body">

                    <div class="calendar">
                        <table class="table">
                            <tbody>
                                    <?php 
                                    foreach($calendar->getWeeks() as $week){
                                        $days = $week->getDays(); 
                                    }
                                    ?>

                                    @foreach ($days as $day)
                                    <tr>
                                    <td class="day-<?php echo mb_strtolower($day->carbon->format("D"))?>">

                                        <?php
                                        $check = mb_strtolower($day->carbon->format("y-m"));
                                        $now = $calendar->getdate()->format("y-m");
                                        $int = mb_strtolower($day->carbon->format("Y-m-d"))."T"."00:00";
                                        ?>

                                        <form method="POST" action="/create">
                                            @CSRF
                                            <input type="hidden" name="start_date" value={{$int}}>
                                            <a href="javascript:void(0)" onclick="this.parentNode.submit()">
                                                <p class="day">{{$day->carbon->format("m/d")}}</p>

                                                @foreach($calendar->schedules() as $key)
                                                <?php
                                                $num = date('Y-m-d', strtotime($key->start_date));
                                                $data = mb_strtolower($day->carbon->format("Y-m-d"));
                                                ?>

                                                @if($num == $data)
                                                {{$key->title}}
                                                @endif

                                                @endforeach
                                            </a>
                                        </form>
                                        @endforeach

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection